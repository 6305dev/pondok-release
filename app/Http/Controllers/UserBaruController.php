<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserBaruController extends Controller
{
    public function index(Request $request)
    {
        $users = \App\Models\User::where('active', 0)->latest()->paginate(10); // ✅ Paginate!

        return view('user_baru', compact('users'));
    }

    public function action(Request $request, $id)
    {
        $user = \App\Models\User::findOrFail($id);
        $action = $request->input('action');
        $phone = $request->input('phone');
        $reason = $request->input('reason');

        try {
            switch ($action) {
                case 'activate':
                    $user->update([
                        'active' => 1,
                        'activation_code' => null,
                        'activation_code_expires_at' => null,
                    ]);

                    return response()->json(['message' => 'User berhasil diaktifkan!']);
                    break;

                case 'edit':
                    $validated = $request->validate([
                        'name' => 'nullable|string|max:255',
                        'email' => 'nullable|email|max:255',
                        'nik' => 'nullable|string|max:255',
                        'kk' => 'nullable|string|max:255',
                        'phone' => 'nullable|string|max:255',
                    ]);
                    $user->update($validated);

                    return response()->json(['message' => 'Data user berhasil diperbarui!']);
                    break;

                case 'reject':
                    $user->forceDelete();

                    return response()->json(['message' => 'Pendaftaran akun ditolak dan akun telah dihapus!']);
                    break;

                default:
                    return response()->json(['message' => 'Aksi tidak valid'], 400);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'Gagal: ' . $e->getMessage()], 500);
        }
    }

    public function resetOtp($id)
    {
        $user = \App\Models\User::findOrFail($id);

        $otp = generateOtp();
        $user->update([
            'activation_code' => $otp,
            'activation_code_expires_at' => now()->addMinutes(10),
        ]);

        return response()->json([
            'message' => "OTP baru: {$otp} (berlaku 10 menit)"
        ]);
    }
}
