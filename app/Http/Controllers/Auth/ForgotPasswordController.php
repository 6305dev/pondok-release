<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResetPasswordEmail;

class ForgotPasswordController extends Controller
{
    /**
     * Memproses permintaan reset password dan mengirim tautan ke email
     */
    public function sendResetLink(Request $request)
    {
        // 1. Validasi input NIK
        $request->validate([
            'nik' => 'required|numeric',
        ], [
            'nik.required' => 'NIK wajib diisi.',
            'nik.numeric' => 'NIK harus berupa angka.',
        ]);

        // 2. Cari user berdasarkan NIK
        $user = User::where('nik', $request->nik)->first();

        if (!$user) {
            return back()->with('swal', [
                'title' => 'Data Tidak Ditemukan',
                'text' => 'NIK yang Anda masukkan tidak terdaftar di sistem kami.',
                'icon' => 'error'
            ]);
        }

        if (!$user->email) {
            return back()->with('swal', [
                'title' => 'Email Tidak Ditemukan',
                'text' => 'Akun Anda tidak memiliki email terdaftar. Silakan hubungi admin.',
                'icon' => 'warning'
            ]);
        }

        // 3. Buat Token Reset & Simpan ke database.
        //    Token disimpan sebagai hash SHA-256 — bukan plaintext — sehingga
        //    kebocoran isi tabel tidak bisa dipakai untuk mereset password.
        //    Token mentah hanya ada di tautan yang dikirim via email.
        $token = Str::random(64);

        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $user->email], // Gunakan email sebagai key sesuai struktur tabel default
            [
                'token' => hash('sha256', $token),
                'created_at' => now()
            ]
        );

        // 4. Susun Link Reset Password
        $resetUrl = url("/password/reset/{$token}?nik=" . $user->nik);

        // 5. Kirim Email Reset Password
        try {
            Mail::to($user->email)->send(new ResetPasswordEmail($user, $resetUrl));
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Gagal mengirim email reset password: ' . $e->getMessage());
            return back()->with('swal', [
                'title' => 'Gagal Mengirim Email',
                'text' => 'Terjadi kendala saat mengirim email. Silakan coba lagi beberapa saat.',
                'icon' => 'error'
            ]);
        }

        // Sensor sebagian email untuk privasi pengguna (contoh: jo***@gmail.com)
        $emailParts = explode('@', $user->email);
        $namePart = $emailParts[0];
        $domainPart = $emailParts[1] ?? '';
        $maskedName = strlen($namePart) > 2 ? substr($namePart, 0, 2) . str_repeat('*', max(1, strlen($namePart) - 2)) : $namePart . '*';
        $maskedEmail = $maskedName . '@' . $domainPart;

        return back()->with('swal', [
            'title' => 'Email Terkirim!',
            'text' => 'Tautan untuk mengatur ulang kata sandi telah dikirim ke email ' . $maskedEmail . '. Silakan periksa kotak masuk atau spam.',
            'icon' => 'success'
        ]);
    }

    /**
     * Menampilkan halaman form password baru
     */
    public function showResetForm(Request $request, $token)
    {
        $user = User::where('nik', $request->nik)->first();

        if (!$user) {
            return redirect()->route('password.request')->with('swal', [
                'title' => 'Link Tidak Valid',
                'text' => 'Pengguna tidak ditemukan.',
                'icon' => 'error'
            ]);
        }

        $resetData = DB::table('password_reset_tokens')
            ->where('email', $user->email)
            ->where('token', hash('sha256', $token))
            ->first();

        // Cek apakah token ada dan belum kadaluarsa (berlaku 15 menit)
        if (!$resetData || \Carbon\Carbon::parse($resetData->created_at)->addMinutes(15)->isPast()) {
            if ($resetData) {
                DB::table('password_reset_tokens')->where('email', $user->email)->delete();
            }
            return redirect()->route('password.request')->with('swal', [
                'title' => 'Link Kadaluarsa',
                'text' => 'Tautan reset password sudah tidak berlaku atau sudah kadaluwarsa (berlaku 15 menit). Silakan minta tautan baru.',
                'icon' => 'error'
            ]);
        }

        return view('auth.reset-password', [
            'token' => $token,
            'nik' => $request->nik
        ]);
    }

    /**
     * Proses update password ke database
     */
    public function updatePassword(Request $request)
    {
        // 1. Validasi input password baru
        $request->validate([
            'token' => 'required',
            'nik' => 'required',
            'password' => 'required|confirmed|min:8',
        ], [
            'password.required' => 'Password baru wajib diisi.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'password.min' => 'Password minimal terdiri dari 8 karakter.',
        ]);

        // 2. Cari user berdasarkan NIK
        $user = User::where('nik', $request->nik)->first();

        if (!$user) {
            return redirect()->route('login')->with('swal', [
                'title' => 'Eror!',
                'text' => 'User tidak valid.',
                'icon' => 'error'
            ]);
        }

        // 3. Verifikasi token di tabel password_reset_tokens (disimpan sebagai hash)
        $resetData = DB::table('password_reset_tokens')
            ->where('email', $user->email)
            ->where('token', hash('sha256', $request->token))
            ->first();

        // Cek apakah token ada dan belum kadaluarsa (berlaku 15 menit)
        if (!$resetData || \Carbon\Carbon::parse($resetData->created_at)->addMinutes(15)->isPast()) {
            if ($resetData) {
                DB::table('password_reset_tokens')->where('email', $user->email)->delete();
            }
            return redirect()->route('password.request')->with('swal', [
                'title' => 'Link Kadaluarsa',
                'text' => 'Tautan reset password sudah tidak berlaku atau sudah kadaluwarsa (berlaku 15 menit). Silakan minta tautan baru.',
                'icon' => 'error'
            ]);
        }

        // 4. Update password user
        $user->update([
            'password' => Hash::make($request->password)
        ]);

        // 5. Hapus token dari database agar tidak bisa dipakai lagi
        DB::table('password_reset_tokens')->where('email', $user->email)->delete();

        return redirect('/login')->with('swal', [
            'title' => 'Sukses!',
            'text' => 'Password Anda berhasil diperbarui. Silakan login menggunakan password baru.',
            'icon' => 'success'
        ]);
    }
}