<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi; // Ganti dengan model transaksi Anda

class KomplainController extends Controller
{
    public function store(Request $request, $id_trx)
    {
        // Validasi input
        $validated = $request->validate([
            'alasan' => 'required|string|max:1000',
        ]);

        // Cari transaksi berdasarkan ID
        $transaksi = Transaksi::findOrFail($id_trx);

        // Simpan komplain ke database (sesuaikan dengan struktur tabel Anda)
        // Misalnya, tambahkan kolom 'komplain_alasan' dan 'status' ke tabel transaksi
        $transaksi->update([
            'alasan' => $validated['alasan'],
            'status' => 7, // Status Komplain
            // ... field lainnya
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Petugas kami akan segera memverifikasi.'
        ]);
    }
}