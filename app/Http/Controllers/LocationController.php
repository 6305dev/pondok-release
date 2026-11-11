<?php

namespace App\Http\Controllers;

use App\Models\SetupKel;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    /**
     * Get desa/kelurahan based on kecamatan ID.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getDesa(Request $request)
    {
        // Gunakan model Eloquent untuk interaksi database yang lebih rapi
        $desas = SetupKel::where('kecamatan_id', $request->kecamatan_id)
                         ->orderBy('nama')
                         ->get(['kode_desa', 'nama']); // Ambil hanya kolom yang dibutuhkan

        return response()->json($desas);
    }
}