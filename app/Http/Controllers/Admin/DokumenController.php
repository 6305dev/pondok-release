<?php

namespace App\Http\Controllers\Admin;

use App\Models\UserDokumen;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

class DokumenController extends Controller
{
    public function upload(Request $request, $idTrx)
    {
        $request->validate([
            'nama_dokumen' => 'required|string|max:255',
            'file' => 'required|mimes:pdf|max:10240', // max 10MB
            'keterangan' => 'nullable|string',
        ]);

        $transaksi = Transaksi::where('id_trx', $idTrx)->firstOrFail();

        $file = $request->file('file');
        $filename = time() . '_' . $file->getClientOriginalName();
        $path = $file->storeAs('uploads/dokumen', $filename, 'local');

        UserDokumen::create([
            'user_id' => auth()->id(), // ID petugas yang upload
            'id_trx' => $idTrx,
            'nama_dokumen' => $request->nama_dokumen,
            'file_path' => $path,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->back()->with('success', 'Dokumen berhasil diunggah!');
    }

    public function delete($id)
    {
        $dokumen = UserDokumen::findOrFail($id);
        Storage::disk('local')->delete($dokumen->file_path);
        $dokumen->delete();

        return redirect()->back()->with('success', 'Dokumen berhasil dihapus!');
    }
}
