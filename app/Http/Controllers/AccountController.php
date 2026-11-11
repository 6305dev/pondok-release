<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\UserLegacy;
use App\Models\SetupKec;

class AccountController extends Controller
{
    public function index()
    {
        $user = UserLegacy::find(session('auth_user_id'));
        
        if ($user && $user->active != 0) {
            $kecamatans = SetupKec::orderBy('nama')->get();
            return view('account.index', compact('user', 'kecamatans'));
        }

        Auth::logout();
        return redirect()->route('login')->with('error', 'Akun Anda tidak dapat diakses.');
    }

    public function update(Request $request)
    {
        $user = UserLegacy::find(session('auth_user_id'));

        if (!$user) {
            Auth::logout();
            return redirect()->route('login')->with('error', 'Sesi tidak valid.');
        }

        $request->validate([
            'email' => 'required|email',
            'phone' => 'required|numeric',
        ]);

        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->save();

        return back()->with('success', 'Data akun berhasil diperbarui.');
    }

    public function updatePassword(Request $request)
    {
        $user = UserLegacy::find(session('auth_user_id'));

        if (!$user) {
            Auth::logout();
            return redirect()->route('login')->with('error', 'Sesi tidak valid.');
        }

        $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Password lama tidak sesuai.']);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return back()->with('password_updated', true);
    }

    public function updateAvatar(Request $request)
    {
        $request->validate([
            'photos' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = UserLegacy::find(session('auth_user_id'));

        if (!$user) {
            Auth::logout();
            return redirect()->route('login')->with('error', 'Sesi tidak valid.');
        }

        if ($request->hasFile('photos')) {
            if ($user->photos) {
                \Illuminate\Support\Facades\Storage::disk('local')->delete('photos/' . $user->photos);
            }

            $file = $request->file('photos');
            $filename = 'avatar_' . $user->id . '_' . time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('photos', $filename, 'local');

            $user->photos = $filename;
            $user->save();
        }

        return redirect()
            ->route('account.index')
            ->with('success', 'Foto profil Anda berhasil diperbarui.');
    }
}