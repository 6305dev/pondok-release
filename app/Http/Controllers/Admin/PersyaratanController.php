<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PersyaratanUmum;
use Illuminate\Http\Request;

class PersyaratanController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin.only'); // proteksi ketat admin saja
    }

    /**
     * Menampilkan daftar semua persyaratan umum
     */
    public function index()
    {
        $persyaratans = PersyaratanUmum::orderBy('id', 'asc')->get();        return view('admin.persyaratan.index', compact('persyaratans'));
    }

    /**
     * Menampilkan form tambah
     */
    public function create()
    {
        $formulirs = \App\Models\Formulir::where('aktif', 'Y')->orderBy('jenis_formulir')->get();
        return view('admin.persyaratan.create', compact('formulirs'));
    }

    /**
     * Menyimpan persyaratan baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'layanan'           => 'required|string|max:100|unique:persyaratan_umum',
            'deskripsi_syarat'  => 'required|string',
            'deskripsi_output'  => 'nullable|string',
        ]);

        PersyaratanUmum::create($request->only(['layanan', 'deskripsi_syarat', 'deskripsi_output']));

        return redirect()
            ->route('admin.persyaratan.index')
            ->with('success', 'Persyaratan berhasil ditambahkan.');
    }

    /**
     * Menampilkan form edit
     */
    public function edit($id)
    {
        $persyaratan = PersyaratanUmum::findOrFail($id);
        $formulirs = \App\Models\Formulir::where('aktif', 'Y')->orderBy('jenis_formulir')->get();
        return view('admin.persyaratan.edit', compact('persyaratan', 'formulirs'));
    }

    /**
     * Memperbarui persyaratan
     */
    public function update(Request $request, $id)
    {
        $persyaratan = PersyaratanUmum::findOrFail($id);

        $request->validate([
            'layanan'           => 'required|string|max:100|unique:persyaratan_umum,layanan,' . $persyaratan->id,
            'deskripsi_syarat'  => 'required|string',
            'deskripsi_output'  => 'nullable|string',
        ]);

        $persyaratan->update($request->only(['layanan', 'deskripsi_syarat', 'deskripsi_output']));

        return redirect()
            ->route('admin.persyaratan.index')
            ->with('success', 'Persyaratan berhasil diperbarui.');
    }

    /**
     * Menghapus persyaratan
     */
    public function destroy($id)
    {
        $persyaratan = PersyaratanUmum::findOrFail($id);
        $persyaratan->delete();

        return redirect()
            ->route('admin.persyaratan.index')
            ->with('success', 'Persyaratan berhasil dihapus.');
    }
}
