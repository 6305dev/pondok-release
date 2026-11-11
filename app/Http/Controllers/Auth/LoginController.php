<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class LoginController extends Controller
{

    public function showLoginForm()
    {
        return view('auth.login');
    }


    public function login(Request $request)
    {
        // Validasi input dasar
        $credentials = $request->validate([
            'nik' => ['required', 'numeric', 'digits:16'],
            'password' => ['required'],
        ], [
            'nik.required' => 'NIK wajib diisi.',
            'nik.numeric' => 'NIK harus berupa angka.',
            'nik.digits' => 'NIK harus 16 digit.',
            'password.required' => 'Password wajib diisi.',
        ]);

        // Cek apakah user ada dengan NIK ini tapi belum aktif dengan password benar
        $user = \App\Models\User::where('nik', $request->nik)->first();
        if ($user && \Illuminate\Support\Facades\Hash::check($request->password, $user->password)) {
            if ($user->active == 0) {
                return redirect()->route('activate.form', ['nik' => $user->nik])->with('swal', [
                    'title' => 'Akun Belum Aktif',
                    'text' => 'Akun Anda belum aktif. Silakan periksa email (' . $user->email . ') Anda untuk kode OTP atau tautan aktivasi akun.',
                    'icon' => 'warning'
                ]);
            }
        }

        // Tambahkan kondisi 'aktif' ke dalam kredensial
        $credentials = array_merge($credentials, ['active' => 1]);

        // Proses login dengan kredensial yang diperbarui
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Store user ID in session for AccountController
            $request->session()->put('auth_user_id', Auth::id());

            $user = Auth::user();
            if (in_array($user->role_id, [1, 4])) {
                return redirect()->intended('/admin/dashboard')->with('success', 'Login berhasil! Selamat datang kembali.');
            }

            // Paksa redirect ke '/' untuk user biasa (role 2) agar tidak terlempar ke halaman admin
            return redirect('/')->with('success', 'Login berhasil! Selamat datang kembali.');
        }

        // Jika gagal, kembalikan pesan kesalahan
        return back()->withErrors([
            'nik' => 'NIK atau Password tidak sesuai, atau akun belum aktif.',
        ])->onlyInput('nik');
    }

    /**
     * Log pengguna keluar dari aplikasi.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
