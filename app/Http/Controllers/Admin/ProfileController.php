<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin.operator'); // Hanya Admin & Operator
    }

    /**
     * Menampilkan profil admin/operator yang sedang login
     */
    public function show()
    {
        $user = auth()->user();
        return view('admin.profile.show', compact('user'));
    }

    /**
     * Memperbarui profil (Nama, Email, Phone)
     */
    public function update(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'required|string|max:20|unique:users,phone,' . $user->id,
        ]);

        $user->update($request->only(['name', 'email', 'phone']));

        return redirect()
            ->route('admin.profile.show')
            ->with('success', 'Profil Anda berhasil diperbarui.');
    }

    /**
     * Menampilkan form ubah password
     */
    public function showPasswordForm()
    {
        return view('admin.profile.password');
    }

    /**
     * Memperbarui password
     */
    public function updatePassword(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password'         => ['required', 'confirmed', Password::min(8)],
        ], [
            'current_password.current_password' => 'Password saat ini salah.',
            'password.confirmed'                => 'Konfirmasi password baru tidak cocok.',
            'password.min'                      => 'Password baru minimal harus 8 karakter.',
        ]);

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()
            ->route('admin.profile.password')
            ->with('success', 'Password Anda berhasil diperbarui.');
    }

    /**
     * Memperbarui foto profil (avatar) admin/operator
     */
    public function updateAvatar(Request $request)
    {
        $request->validate([
            'photos' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = auth()->user();

        if ($request->hasFile('photos')) {
            if ($user->photos) {
                \Illuminate\Support\Facades\Storage::disk('local')->delete('photos/' . $user->photos);
            }

            $file = $request->file('photos');
            $filename = 'avatar_' . $user->id . '_' . time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('photos', $filename, 'local');

            $user->update(['photos' => $filename]);
        }

        return redirect()
            ->route('admin.profile.show')
            ->with('success', 'Foto profil Anda berhasil diperbarui.');
    }
}
