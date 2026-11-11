<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    public function index()
    {
        $jadwal = Jadwal::orderByRaw("FIELD(hari, 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu')")->get();
        return view('admin.jadwal.index', compact('jadwal')); // <-- Ini kunci utamanya
    }

    public function edit($id)
    {
        $jadwal = Jadwal::findOrFail($id);
        return view('admin.jadwal.edit', compact('jadwal'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'jam_buka' => 'required|date_format:H:i',
            'jam_tutup' => 'required|date_format:H:i|after:jam_buka',
            'pesan_tutup' => 'nullable|string',
        ]);

        $jadwal = Jadwal::findOrFail($id);
        $jadwal->update([
            'jam_buka' => $request->jam_buka,
            'jam_tutup' => $request->jam_tutup,
            'aktif' => $request->has('aktif') ? true : false,
            'pesan_tutup' => $request->pesan_tutup,
        ]);

        return redirect()->route('admin.jadwal.index')->with('success', 'Jadwal berhasil diperbarui.');
    }
}