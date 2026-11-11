<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use App\Models\SetupKec; // Menggunakan model untuk mengambil data kecamatan
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Mail;
use App\Mail\ActivationEmail;

class RegisterController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Tampilkan formulir registrasi.
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Tangani permintaan registrasi.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(Request $request)
    {
        try {
            // Validasi data yang masuk
            $this->validator($request->all())->validate();

            // Buat instance user baru (status non-aktif)
            $user = $this->create($request->all());

            // Generate OTP aktivasi
            $otp = generateOtp();
            $user->update([
                'activation_code' => $otp,
                'activation_code_expires_at' => now()->addMinutes(15),
            ]);

            // Kirim event Registered
            event(new Registered($user));

            // Kirim Email Aktivasi (OTP & Direct Link)
            $activationUrl = route('activate.link', ['nik' => $user->nik, 'otp' => $otp]);
            try {
                Mail::to($user->email)->send(new ActivationEmail($user, $otp, $activationUrl));
            } catch (\Exception $mailEx) {
                \Illuminate\Support\Facades\Log::error('Gagal mengirim email aktivasi: ' . $mailEx->getMessage());
            }

            return redirect()->route('activate.form', ['nik' => $user->nik])->with('swal', [
                'title' => 'Registrasi Berhasil!',
                'text' => 'Kode OTP dan tautan aktivasi akun telah dikirim ke email ' . $user->email . '. Silakan periksa kotak masuk atau folder spam Anda.',
                'icon' => 'success'
            ]);
        } catch (ValidationException $e) {
            // Tangani error validasi
            return back()->withErrors($e->validator)->withInput();
        }
    }

    /**
     * Dapatkan validator untuk permintaan registrasi yang masuk.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'nik' => ['required', 'string', 'digits:16', 'unique:users,nik'],
            'kk' => ['required', 'string', 'digits:16'],
            'phone' => ['required', 'string', 'regex:/^([0-9\s\-\+\(\)]*)$/', 'min:10', 'max:15'],
            'kecamatan' => ['nullable', 'integer', 'exists:kecamatan,id'],
            'desa_kelurahan' => ['nullable', 'integer', 'exists:desa,kode_desa'],
        ]);
    }

    /**
     * Buat instance pengguna baru setelah registrasi yang valid.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'nik' => $data['nik'],
            'kk' => $data['kk'],
            'phone' => $data['phone'],
            'role_id' => 2,
            'id_kec' => $data['kecamatan'] ?? null,
            'kode_desa' => $data['desa_kelurahan'] ?? null,
            'active' => 0,
            'photos' => null,
        ]);
    }
}
