<?php

namespace App\Http\Controllers;

use App\Models\ChatMessage;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

/**
 * Chat internal tanpa realtime (menggantikan server chat eksternal).
 *
 * Satu thread per user client: semua pesan thread menunjuk ke
 * conversation_user_id, sehingga staf mana pun dapat melihat dan
 * melanjutkan percakapan yang sama. Pesan baru muncul lewat polling
 * parameter after_id dari sisi browser.
 */
class ChatController extends Controller
{
    /**
     * Riwayat percakapan (ASC). User biasa selalu dipaksa ke thread
     * miliknya sendiri; staf boleh memilih thread pengguna mana pun
     * ({peerId} = id user client). Memuat percakapan sekaligus menandai
     * pesan lawan bicara sebagai terbaca.
     */
    public function conversation(Request $request, ?int $peerId = null): JsonResponse
    {
        $user = $request->user();
        $isStaff = $user->isStaff();

        if ($isStaff && $peerId === null) {
            abort(400, 'peerId wajib diisi.');
        }

        $conversationUserId = $isStaff ? $peerId : $user->id;

        $this->abortIfConversationMissing($conversationUserId, $isStaff);

        $query = ChatMessage::with('sender')
            ->forConversation($conversationUserId);

        // Polling: hanya ambil pesan yang lebih baru dari after_id
        $afterId = $request->query('after_id');
        if (is_numeric($afterId) && $afterId > 0) {
            $query->where('id', '>', (int) $afterId);
        }

        $messages = $query->get();

        // Menandai pesan lawan bicara sebagai terbaca saat thread dibuka
        if ($messages->isNotEmpty()) {
            ChatMessage::forConversation($conversationUserId)
                ->whereNull('read_at')
                ->when($isStaff, fn ($q) => $q->fromClient())
                ->unless($isStaff, fn ($q) => $q->fromStaff())
                ->update(['read_at' => now()]);
        }

        return response()->json(
            $messages->map(fn (ChatMessage $m) => $m->toChatArray($user->id))->values()
        );
    }

    /**
     * Daftar seluruh thread percakapan client (khusus staf):
     * data user, pesan terakhir, dan jumlah pesan belum dibaca.
     * Jumlah query konstanta (5) terlepas dari banyaknya thread
     * karena endpoint ini dipanggil berkala untuk badge.
     */
    public function adminConversations(Request $request): JsonResponse
    {
        $user = $request->user();
        abort_unless($user->isStaff(), 403);

        $viewerId = $user->id;

        // Pesan terakhir tiap thread
        $lastIds = ChatMessage::query()
            ->selectRaw('MAX(id) as last_id')
            ->groupBy('conversation_user_id')
            ->pluck('last_id');

        // Jumlah belum dibaca per thread
        $unread = ChatMessage::query()
            ->fromClient()
            ->whereNull('read_at')
            ->selectRaw('conversation_user_id, COUNT(*) as total')
            ->groupBy('conversation_user_id')
            ->pluck('total', 'conversation_user_id');

        // Urutan thread: aktivitas terbaru dulu
        $lastMessages = ChatMessage::query()
            ->with('sender:id,name')
            ->whereIn('id', $lastIds)
            ->orderByDesc('id')
            ->get();

        $clients = User::query()
            ->whereIn('id', $lastMessages->pluck('conversation_user_id'))
            ->get()
            ->keyBy('id');

        $result = [];
        foreach ($lastMessages as $last) {
            $client = $clients->get($last->conversation_user_id);
            if (! $client) {
                continue;
            }

            $result[] = [
                'user' => [
                    'id' => $client->id,
                    'name' => $client->name,
                    'nik' => $client->nik,
                ],
                'lastMessage' => $last->toChatArray($viewerId),
                'unreadCount' => (int) $unread->get($client->id, 0),
            ];
        }

        return response()->json($result);
    }

    /**
     * Kirim pesan teks dan/atau gambar.
     * User biasa selalu mengirim ke thread miliknya sendiri; staf
     * menentukan thread tujuan lewat peer_id (id user client).
     */
    public function send(Request $request): JsonResponse
    {
        $user = $request->user();
        $isStaff = $user->isStaff();

        $data = $request->validate([
            'peer_id' => $isStaff ? 'required|integer|exists:users,id' : 'prohibited',
            'content' => 'nullable|required_without:image|string|max:2000',
            // Whitelist ekstensi (memblokir SVG/PHP/GIF) + verifikasi
            // konten dengan getimagesize(). Rule mimetypes bawaan tidak
            // andal karena UploadedFile::getMimeType() fallback ke
            // ekstensi, sehingga file HTML yang di-rename .png bisa lolos.
            'image' => [
                'nullable',
                'required_without:content',
                'file',
                'mimes:jpg,jpeg,png,webp',
                'max:5120',
                function (string $attribute, mixed $value, \Closure $fail) {
                    // getimagesize membaca byte header file, bukan sekadar
                    // nama file; konten juga harus sesuai format yang
                    // diizinkan sehingga GIF/HTML yang di-rename .png
                    // ikut tertolak.
                    $info = @getimagesize($value->getRealPath());
                    $allowedMimes = ['image/jpeg', 'image/png', 'image/webp'];
                    if ($info === false || ! in_array($info['mime'], $allowedMimes, true)) {
                        $fail('Berkas harus berupa gambar JPG, PNG, atau WebP yang valid.');
                    }
                },
            ],
        ]);

        $conversationUserId = $isStaff ? (int) $data['peer_id'] : $user->id;

        $this->abortIfConversationMissing($conversationUserId, $isStaff);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('chat', 'local');
        }

        $message = ChatMessage::create([
            'conversation_user_id' => $conversationUserId,
            'sender_id' => $user->id,
            'content' => $data['content'] ?? null,
            'image_path' => $imagePath,
            // read_at dibiarkan null: ditandai hanya saat lawan bicara
            // memuat thread (badge unread penerima tetap jalan)
        ]);

        return response()->json($message->toChatArray($user->id), 201);
    }

    /**
     * Jumlah pesan belum dibaca untuk badge user biasa.
     */
    public function unreadCount(Request $request): JsonResponse
    {
        $count = ChatMessage::forConversation($request->user()->id)
            ->fromStaff()
            ->whereNull('read_at')
            ->count();

        return response()->json(['count' => $count]);
    }

    /**
     * Menyajikan gambar lampiran chat dari disk "local".
     * Hanya pemilik thread atau staf yang boleh mengakses.
     */
    public function image(Request $request, string $path)
    {
        $user = $request->user();

        // Route hanya menerima satu segmen (nama file); tolak bentuk
        // path apa pun yang mencurigakan sebelum dirangkai.
        abort_if(
            $path === '' || str_contains($path, '/') || str_contains($path, '\\') || str_contains($path, '..'),
            404
        );

        $relativePath = 'chat/' . $path;

        $message = ChatMessage::where('image_path', $relativePath)->first();
        abort_unless($message, 404, 'Lampiran tidak ditemukan.');

        $hasAccess = $user->isStaff()
            || $message->conversation_user_id === $user->id
            || $message->sender_id === $user->id;
        abort_unless($hasAccess, 403, 'Anda tidak memiliki hak akses untuk lampiran ini.');

        abort_unless(Storage::disk('local')->exists($relativePath), 404, 'File tidak ditemukan.');

        // Content-Type dipaksa sesuai whitelist ekstensi (bukan diguess
        // dari isi file) + nosniff, sehingga file bertopeng HTML/JS
        // tidak pernah dirender sebagai dokumen oleh browser.
        $mimeTypes = [
            'jpg' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'png' => 'image/png',
            'webp' => 'image/webp',
        ];
        $extension = strtolower(pathinfo($path, PATHINFO_EXTENSION));
        abort_unless(isset($mimeTypes[$extension]), 404, 'Format file tidak didukung.');

        return Storage::disk('local')->response($relativePath, null, [
            'Content-Type' => $mimeTypes[$extension],
            'X-Content-Type-Options' => 'nosniff',
        ]);
    }

    /**
     * Staf hanya boleh membuka thread user client (bukan thread staf lain).
     */
    private function abortIfConversationMissing(int $conversationUserId, bool $isStaff): void
    {
        $client = User::find($conversationUserId);
        abort_unless($client, 404, 'Percakapan tidak ditemukan.');

        if ($isStaff && in_array($client->role_id, ChatMessage::STAFF_ROLES, true)) {
            abort(403, 'Hanya thread user client yang dapat diakses.');
        }
    }
}
