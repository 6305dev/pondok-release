<?php

namespace App\Http\Controllers;

use App\Models\Formulir;
use Illuminate\Http\Request;

class FormulirController extends Controller
{
    public function index()
    {
        // ✅ Hanya tampilkan formulir aktif
        $formulirs = Formulir::where('aktif', 'Y')->orderBy('jenis_formulir')->get();
        return view('formulir.index', compact('formulirs'));
    }

    public function download($filename)
    {
        // Cegah path traversal: tolak nama file yang mengandung pemisah direktori
        if (str_contains($filename, '/') || str_contains($filename, '\\') || str_contains($filename, '..') || $filename !== basename($filename)) {
            return abort(404, 'File tidak ditemukan.');
        }

        $path = storage_path('app/private/dok_formulir/' . $filename);
        if (!file_exists($path)) {
            return abort(404, 'File tidak ditemukan.');
        }
        return response()->download($path);
    }
}