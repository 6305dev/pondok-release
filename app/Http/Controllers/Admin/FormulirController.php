<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Formulir;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FormulirController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin.only'); // proteksi ketat admin saja
    }

    /**
     * Menampilkan daftar semua formulir (aktif & non-aktif)
     */
    public function index()
    {
        $formulirs = Formulir::orderBy('jenis_formulir')->get();
        return view('admin.formulir.index', compact('formulirs'));
    }

    /**
     * Menampilkan form tambah
     */
    public function create()
    {
        return view('admin.formulir.create');
    }

    /**
     * Menyimpan formulir baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'jenis_formulir' => 'required|string|max:100|unique:formulir',
            'keterangan'     => 'required|string',
            'dokumen'        => 'required|file|mimes:pdf|max:10240', // ≤10MB
            'aktif'          => 'required|in:Y,N',
        ], [
            'dokumen.required' => 'File PDF wajib diunggah.',
            'dokumen.mimes'    => 'Hanya file berformat PDF yang diperbolehkan.',
            'dokumen.max'      => 'Ukuran file tidak boleh melebihi 10 MB.',
        ]);

        $data = $request->only(['jenis_formulir', 'keterangan', 'aktif']);

        // ✅ Upload ke folder: storage/app/private/dok_formulir
        $file = $request->file('dokumen');
        $ext = $file->getClientOriginalExtension();
        $name = Str::slug($request->jenis_formulir) . '_' . time() . '.' . $ext;

        // Simpan via disk 'local' → folder 'dok_formulir'
        $file->storeAs('dok_formulir', $name, 'local');
        $data['dokumen'] = $name;

        Formulir::create($data);

        return redirect()
            ->route('admin.formulir.index')
            ->with('success', 'Formulir berhasil ditambahkan.');
    }

    /**
     * Menampilkan form edit
     */
    public function edit(Formulir $formulir)
    {
        return view('admin.formulir.edit', compact('formulir'));
    }

    /**
     * Memperbarui formulir
     */
    public function update(Request $request, Formulir $formulir)
    {
        $request->validate([
            'jenis_formulir' => 'required|string|max:100|unique:formulir,jenis_formulir,' . $formulir->id,
            'keterangan'     => 'required|string',
            'dokumen'        => 'nullable|file|mimes:pdf|max:10240',
            'aktif'          => 'required|in:Y,N',
        ]);

        $data = $request->only(['jenis_formulir', 'keterangan', 'aktif']);

        // Jika ada file baru di-upload
        if ($request->hasFile('dokumen')) {
            // Hapus file lama
            if ($formulir->dokumen) {
                Storage::disk('local')->delete('dok_formulir/' . $formulir->dokumen);
            }

            $file = $request->file('dokumen');
            $ext = $file->getClientOriginalExtension();
            $name = Str::slug($request->jenis_formulir) . '_' . time() . '.' . $ext;
            $file->storeAs('dok_formulir', $name, 'local');
            $data['dokumen'] = $name;
        }

        $formulir->update($data);

        return redirect()
            ->route('admin.formulir.index')
            ->with('success', 'Formulir berhasil diperbarui.');
    }

    /**
     * Menghapus formulir + dokumen fisik
     */
    public function destroy(Formulir $formulir)
    {
        if ($formulir->dokumen) {
            Storage::disk('local')->delete('dok_formulir/' . $formulir->dokumen);
        }

        $formulir->delete();

        return redirect()
            ->route('admin.formulir.index')
            ->with('success', 'Formulir berhasil dihapus.');
    }
}