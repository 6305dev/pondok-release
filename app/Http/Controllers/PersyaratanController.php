<?php

namespace App\Http\Controllers;

use App\Models\PersyaratanUmum;
use Illuminate\Http\Request;

class PersyaratanController extends Controller
{
    public function index()
    {
        $persyaratans = PersyaratanUmum::orderBy('id', 'asc')->get();

        // Mapping nama lengkap dan ikon SVG
        $namaLengkapMap = [
            'KIA' => [
                'nama' => 'Kartu Identitas Anak',
                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6" style="color: #dc2626;"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Z" /></svg>',
            ],
            'KTP' => [
                'nama' => 'Kartu Tanda Penduduk',
                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6" style="color: #2563eb;"><path stroke-linecap="round" stroke-linejoin="round" d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Zm6-10.125a1.875 1.875 0 1 1-3.75 0 1.875 1.875 0 0 1 3.75 0Zm1.294 6.336a6.721 6.721 0 0 1-3.17.789 6.721 6.721 0 0 1-3.168-.789 3.376 3.376 0 0 1 6.338 0Z" /></svg>',
            ],
            'DTG' => [
                'nama' => 'Kedatangan',
                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6" style="color: #0891b2;"><path stroke-linecap="round" stroke-linejoin="round" d="M9 3.75H6.912a2.25 2.25 0 0 0-2.15 1.588L2.35 13.177a2.25 2.25 0 0 0-.1.661V18a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18v-4.162c0-.224-.034-.447-.1-.661L19.24 5.338a2.25 2.25 0 0 0-2.15-1.588H15M2.25 13.5h3.86a2.25 2.25 0 0 1 2.012 1.244l.256.512a2.25 2.25 0 0 0 2.013 1.244h3.218a2.25 2.25 0 0 0 2.013-1.244l.256-.512a2.25 2.25 0 0 1 2.013-1.244h3.859M12 3v8.25m0 0-3-3m3 3 3-3" /></svg>'
            ],
            'PDH' => [
                'nama' => 'Perpindahan',
                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6" style="color: #166534;"><path stroke-linecap="round" stroke-linejoin="round" d="M15.59 14.37a6 6 0 0 1-5.84 7.38v-4.8m5.84-2.58a14.98 14.98 0 0 0 6.16-12.12A14.98 14.98 0 0 0 9.631 8.41m5.96 5.96a14.926 14.926 0 0 1-5.841 2.58m-.119-8.54a6 6 0 0 0-7.381 5.84h4.8m2.581-5.84a14.927 14.927 0 0 0-2.58 5.84m2.699 2.7c-.103.021-.207.041-.311.06a15.09 15.09 0 0 1-2.448-2.448 14.9 14.9 0 0 1 .06-.312m-2.24 2.39a4.493 4.493 0 0 0-1.757 4.306 4.493 4.493 0 0 0 4.306-1.758M16.5 9a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z" /></svg>',
            ],
            'KK' => [
                'nama' => 'Kartu Keluarga',
                'icon' => '<svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.456 9.118 5 7.5 5S4.168 5.456 3 6.253v13C4.168 18.456 5.882 18 7.5 18s3.332.456 4.5 1.253m0-13C13.168 5.456 14.882 5 16.5 5c1.618 0 3.332.456 4.5 1.253v13C19.832 18.456 18.118 18 16.5 18c-1.618 0-3.332.456-4.5 1.253"></path></svg>',
            ],
            'ALH' => [
                'nama' => 'Akta Kelahiran',
                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6" style="color: #db2777;"><path stroke-linecap="round" stroke-linejoin="round" d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z" /></svg>',
            ],
            'AMT' => [
                'nama' => 'Akta Kematian',
                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6" style="color: #000000;"><path stroke-linecap="round" stroke-linejoin="round" d="M22 10.5h-6m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM4 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 10.374 21c-2.331 0-4.512-.645-6.374-1.766Z" /></svg>',
            ],
            'AKW' => [
                'nama' => 'Akta Perkawinan',
                'icon' => '<svg class="w-6 h-6 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>',
            ],
            'ACR' => [
                'nama' => 'Akta Perceraian',
                'icon' => '<svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l-4-4m8 8l-4-4"></path></svg>',
            ],
        ];

        // Memetakan ke key map agar mendapat ikon dan penulisan nama lengkap yang sama
        foreach ($persyaratans as $item) {
            $key = '';
            if (stripos($item->layanan, 'keluarga') !== false || stripos($item->layanan, 'kk') !== false) {
                $key = 'KK';
            } elseif (stripos($item->layanan, 'tanda penduduk') !== false || stripos($item->layanan, 'ktp') !== false) {
                $key = 'KTP';
            } elseif (stripos($item->layanan, 'anak') !== false || stripos($item->layanan, 'kia') !== false) {
                $key = 'KIA';
            } elseif (stripos($item->layanan, 'datang') !== false || stripos($item->layanan, 'kedatangan') !== false) {
                $key = 'DTG';
            } elseif (stripos($item->layanan, 'pindah') !== false || stripos($item->layanan, 'perpindahan') !== false) {
                $key = 'PDH';
            } elseif (stripos($item->layanan, 'kelahiran') !== false) {
                $key = 'ALH';
            } elseif (stripos($item->layanan, 'kematian') !== false) {
                $key = 'AMT';
            } elseif (stripos($item->layanan, 'perkawinan') !== false) {
                $key = 'AKW';
            } elseif (stripos($item->layanan, 'perceraian') !== false) {
                $key = 'ACR';
            }

            if ($key && isset($namaLengkapMap[$key])) {
                $item->nama_lengkap = $namaLengkapMap[$key]['nama'];
                $item->icon_svg = $namaLengkapMap[$key]['icon'];
            } else {
                $item->nama_lengkap = $item->layanan;
                $item->icon_svg = '<svg class="w-6 h-6 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>';
            }
        }

        return view('persyaratan', compact('persyaratans'));
    }
}