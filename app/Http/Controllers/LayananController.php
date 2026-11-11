<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LayananController extends Controller
{
    /**
     * Tampilkan halaman menu layanan.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('layanan'); // Mengembalikan view layanan.blade.php
    }
}
