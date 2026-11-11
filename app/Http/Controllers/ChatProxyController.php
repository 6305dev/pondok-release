<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;

/**
 * Proxy REST API server chat.
 *
 * Sebelumnya SECRET_KEY disematkan langsung di JavaScript tiga halaman
 * blade (pesan-client, pesan-admin, layouts/admin) sehingga bocor ke
 * siapa pun yang membuka view-source. Semua panggilan REST kini
 * diforward dari sisi server; koneksi websocket socket.io tetap
 * langsung ke server chat karena tidak memakai kunci.
 */
class ChatProxyController extends Controller
{
    /**
     * Peran yang boleh membaca percakapan pengguna lain dan daftar
     * percakapan admin (1=Admin, 3=Verifikator, 4=Operator).
     */
    private const STAFF_ROLES = [1, 3, 4];

    /**
     * Percakapan antara admin dan seorang pengguna.
     *
     * User biasa selalu dipaksa ke percakapan miliknya sendiri;
     * staf boleh memilih pengguna mana pun ({peerId}).
     */
    public function conversation(Request $request, ?string $peerId = null): Response
    {
        $user = $request->user();

        if (! in_array($user->role_id, self::STAFF_ROLES)) {
            $peerId = null;
        }

        $target = $peerId ?: $user->nik;

        return $this->forward('/chat/messages/' . config('services.chat.admin_id') . '/' . $target);
    }

    /**
     * Daftar seluruh percakapan admin (khusus staf).
     */
    public function adminConversations(Request $request): Response
    {
        abort_unless(in_array($request->user()->role_id, self::STAFF_ROLES), 403);

        return $this->forward('/chat/messages/admin/' . config('services.chat.admin_id'));
    }

    /**
     * Upload gambar chat (multipart dipass-through, tidak di-buffer).
     */
    public function upload(Request $request): Response
    {
        $request->validate([
            'image' => 'required|file|image|max:5120',
        ]);

        $file = $request->file('image');

        try {
            $response = Http::timeout(30)->withHeaders([
                'Authorization' => 'Bearer ' . config('services.chat.secret'),
                'Accept' => 'application/json',
            ])->attach(
                'image',
                $file->getContent(),
                $file->getClientOriginalName(),
                $file->getClientMimeType(),
            )->post($this->chatUrl() . '/chat/upload');
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            abort(502, 'Server chat tidak dapat dijangkau.');
        }

        return $this->passthrough($response);
    }

    /**
     * Forward request GET ke server chat dengan kredensial server-side.
     */
    private function forward(string $path): Response
    {
        try {
            $response = Http::timeout(10)->withHeaders([
                'Authorization' => 'Bearer ' . config('services.chat.secret'),
                'Accept' => 'application/json',
            ])->get($this->chatUrl() . $path);
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            abort(502, 'Server chat tidak dapat dijangkau.');
        }

        return $this->passthrough($response);
    }

    private function chatUrl(): string
    {
        $url = rtrim((string) config('services.chat.url'), '/');

        abort_if($url === '', 503, 'Server chat tidak dikonfigurasi.');

        return $url;
    }

    private function passthrough($response): Response
    {
        return response($response->body(), $response->status())
            ->header('Content-Type', $response->header('Content-Type') ?: 'application/json');
    }
}
