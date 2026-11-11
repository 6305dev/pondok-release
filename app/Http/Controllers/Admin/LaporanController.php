<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use App\Models\JenisPelayanan;
use App\Models\SetupKec;
use App\Models\SetupKel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        // Default filter tanggal: awal bulan ini s/d hari ini
        $tgl_awal = $request->input('tgl_awal', Carbon::now()->startOfMonth()->toDateString());
        $tgl_akhir = $request->input('tgl_akhir', Carbon::now()->toDateString());

        // Menggunakan filter waktu mulai 00:00:00 sampai 23:59:59
        $startDate = $tgl_awal . ' 00:00:00';
        $endDate = $tgl_akhir . ' 23:59:59';

        // =========================================================================
        // 1. Rekapitulasi Permohonan berdasarkan daerah Kecamatan dan Kelurahan/Desa
        // =========================================================================
        $kecamatans = SetupKec::orderBy('nama')->get();
        $desas = SetupKel::orderBy('nama')->get();

        // Ambil data transaksi yang terfilter tanggal, kelompokkan berdasarkan id_kec dan id_kel
        $transaksiCounts = Transaksi::whereBetween('tgl', [$startDate, $endDate])
            ->select('id_kec', 'id_kel', DB::raw('count(*) as total'))
            ->groupBy('id_kec', 'id_kel')
            ->get()
            ->groupBy('id_kec');

        $rekapKecKel = [];
        foreach ($kecamatans as $kec) {
            $kecId = $kec->id;
            $kecTotal = 0;
            $kecDesas = [];

            // Ambil semua kelurahan/desa yang berada di bawah kecamatan ini
            $filteredDesas = $desas->where('kecamatan_id', $kecId);
            
            foreach ($filteredDesas as $desa) {
                $desaCode = $desa->kode_desa;
                $total = 0;
                
                if (isset($transaksiCounts[$kecId])) {
                    $desaCount = $transaksiCounts[$kecId]->where('id_kel', $desaCode)->first();
                    if ($desaCount) {
                        $total = $desaCount->total;
                    }
                }
                
                $kecDesas[] = [
                    'kode_desa' => $desaCode,
                    'nama' => $desa->nama,
                    'total' => $total
                ];
                $kecTotal += $total;
            }

            $rekapKecKel[] = [
                'id' => $kecId,
                'nama' => $kec->nama,
                'total' => $kecTotal,
                'desas' => $kecDesas
            ];
        }

        // Hitung transaksi yang kecamatannya tidak terdefinisi/null (data anomali jika ada)
        $allKecIds = $kecamatans->pluck('id')->toArray();
        $unmatchedCount = Transaksi::whereBetween('tgl', [$startDate, $endDate])
            ->where(function($q) use ($allKecIds) {
                $q->whereNotIn('id_kec', $allKecIds)
                  ->orWhereNull('id_kec');
            })
            ->count();

        if ($unmatchedCount > 0) {
            $rekapKecKel[] = [
                'id' => 'unmatched',
                'nama' => 'Tidak Diketahui / Lainnya',
                'total' => $unmatchedCount,
                'desas' => []
            ];
        }

        // =========================================================================
        // 2. Rekapitulasi berdasarkan jenis dokumen (id_dokumen) termasuk id_dokumen yang > 1 dalam 1 transaksi
        // =========================================================================
        $transaksis = Transaksi::whereBetween('tgl', [$startDate, $endDate])
            ->select('id_trx', 'id_dokumen')
            ->get();

        $categoryMap = [
            'KK'  => 'Kartu Keluarga',
            'KTP' => 'KTP',
            'KIA' => 'KIA',
            'PDH' => 'Pindah',
            'DTG' => 'Datang',
            'ALH' => 'Akta Kelahiran',
            'AMT' => 'Akta Kematian',
            'AKW' => 'Akta Perkawinan',
            'ACR' => 'Akta Perceraian',
        ];

        $newFormatMap = [
            '1' => 'Kartu Keluarga',
            '2' => 'KTP',
            '3' => 'KIA',
            '4' => 'Pindah',  
            '5' => 'Datang',
            '6' => 'Akta Kelahiran',                    
            '7' => 'Akta Kematian',
            '8' => 'Akta Perkawinan',
            '9' => 'Akta Perceraian',
            '10' => 'Lainnya',
        ];

        $rekapDokumen = [
            'KK' => ['id' => 'KK', 'nama' => 'Kartu Keluarga', 'keterangan' => 'Permohonan Kartu Keluarga', 'total' => 0],
            'KTP' => ['id' => 'KTP', 'nama' => 'KTP', 'keterangan' => 'Permohonan Kartu Tanda Penduduk', 'total' => 0],
            'KIA' => ['id' => 'KIA', 'nama' => 'KIA', 'keterangan' => 'Permohonan Kartu Identitas Anak', 'total' => 0],
            'PDH' => ['id' => 'PDH', 'nama' => 'Pindah', 'keterangan' => 'Permohonan Surat Pindah Keluar', 'total' => 0],
            'DTG' => ['id' => 'DTG', 'nama' => 'Datang', 'keterangan' => 'Permohonan Surat Keterangan Datang', 'total' => 0],
            'ALH' => ['id' => 'ALH', 'nama' => 'Akta Kelahiran', 'keterangan' => 'Permohonan Akta Kelahiran', 'total' => 0],
            'AMT' => ['id' => 'AMT', 'nama' => 'Akta Kematian', 'keterangan' => 'Permohonan Akta Kematian', 'total' => 0],
            'AKW' => ['id' => 'AKW', 'nama' => 'Akta Perkawinan', 'keterangan' => 'Permohonan Akta Perkawinan', 'total' => 0],
            'ACR' => ['id' => 'ACR', 'nama' => 'Akta Perceraian', 'keterangan' => 'Permohonan Akta Perceraian', 'total' => 0],
        ];

        $pelayanan = JenisPelayanan::all()->keyBy('id');

        foreach ($transaksis as $trx) {
            $rawLayanan = $trx->id_dokumen;
            if (empty($rawLayanan)) {
                continue;
            }

            $isDataLama = !str_contains($rawLayanan, '[');

            if ($isDataLama) {
                $cleanId = trim(str_replace(['"', "'"], '', $rawLayanan));
                if (isset($pelayanan[$cleanId])) {
                    $p = $pelayanan[$cleanId];
                    $kat = $p->keterangan; // KK, KTP, KIA, etc.
                    if (isset($rekapDokumen[$kat])) {
                        $rekapDokumen[$kat]['total']++;
                    } else {
                        if (!isset($rekapDokumen['Lainnya'])) {
                            $rekapDokumen['Lainnya'] = ['id' => 'Lainnya', 'nama' => 'Lainnya', 'keterangan' => 'Layanan Lainnya / Tidak Terdefinisi', 'total' => 0];
                        }
                        $rekapDokumen['Lainnya']['total']++;
                    }
                } else {
                    if (!isset($rekapDokumen['Lainnya'])) {
                        $rekapDokumen['Lainnya'] = ['id' => 'Lainnya', 'nama' => 'Lainnya', 'keterangan' => 'Layanan Lainnya / Tidak Terdefinisi', 'total' => 0];
                    }
                    $rekapDokumen['Lainnya']['total']++;
                }
            } else {
                $cleanJson = html_entity_decode($rawLayanan);
                $ids = json_decode($cleanJson, true);
                if (is_array($ids)) {
                    foreach ($ids as $id) {
                        $cleanId = trim((string)$id);
                        $katName = $newFormatMap[$cleanId] ?? 'Lainnya';
                        
                        $keyMap = [
                            'Kartu Keluarga' => 'KK',
                            'KTP' => 'KTP',
                            'KIA' => 'KIA',
                            'Pindah' => 'PDH',
                            'Datang' => 'DTG',
                            'Akta Kelahiran' => 'ALH',
                            'Akta Kematian' => 'AMT',
                            'Akta Perkawinan' => 'AKW',
                            'Akta Perceraian' => 'ACR',
                            'Lainnya' => 'Lainnya',
                        ];
                        
                        $key = $keyMap[$katName] ?? 'Lainnya';
                        if ($key === 'Lainnya') {
                            if (!isset($rekapDokumen['Lainnya'])) {
                                $rekapDokumen['Lainnya'] = ['id' => 'Lainnya', 'nama' => 'Lainnya', 'keterangan' => 'Layanan Lainnya / Tidak Terdefinisi', 'total' => 0];
                            }
                        }
                        if (isset($rekapDokumen[$key])) {
                            $rekapDokumen[$key]['total']++;
                        }
                    }
                }
            }
        }

        // =========================================================================
        // 3. Laporan Berdasarkan status pengajuan (baru/verifikasi dan lainnya)
        // =========================================================================
        $statusCounts = Transaksi::whereBetween('tgl', [$startDate, $endDate])
            ->select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status')
            ->toArray();

        $statusLabels = Transaksi::statusLabels();
        $rekapStatus = [];
        foreach ($statusLabels as $statusCode => $label) {
            $rekapStatus[] = [
                'status' => $statusCode,
                'label' => $label,
                'total' => $statusCounts[$statusCode] ?? 0,
                'badge_class' => $this->getStatusBadgeClass($statusCode)
            ];
        }

        // =========================================================================
        // 4. Laporan Pengajuan per bulan
        // =========================================================================
        $monthlyData = Transaksi::whereBetween('tgl', [$startDate, $endDate])
            ->select(
                DB::raw("DATE_FORMAT(tgl, '%Y-%m') as bulan"),
                DB::raw('count(*) as total')
            )
            ->groupBy('bulan')
            ->orderBy('bulan', 'asc')
            ->get();

        $rekapBulanan = [];
        foreach ($monthlyData as $row) {
            $rekapBulanan[] = [
                'bulan_raw' => $row->bulan,
                'bulan' => $this->formatIndoMonth($row->bulan),
                'total' => $row->total
            ];
        }

        // =========================================================================
        // 5. Laporan Rating / Penilaian
        // =========================================================================
        $ratingsQuery = Transaksi::whereBetween('tgl', [$startDate, $endDate])
            ->whereNotNull('rating')
            ->where('rating', '>', 0);

        $totalRatings = $ratingsQuery->count();
        $averageRating = $totalRatings > 0 ? round($ratingsQuery->avg('rating'), 1) : 0;

        $starCounts = [
            5 => 0,
            4 => 0,
            3 => 0,
            2 => 0,
            1 => 0
        ];

        $ratingGroup = Transaksi::whereBetween('tgl', [$startDate, $endDate])
            ->whereNotNull('rating')
            ->where('rating', '>', 0)
            ->select('rating', DB::raw('count(*) as total'))
            ->groupBy('rating')
            ->pluck('total', 'rating')
            ->toArray();

        foreach ($ratingGroup as $star => $count) {
            $intStar = (int)$star;
            if (isset($starCounts[$intStar])) {
                $starCounts[$intStar] = $count;
            }
        }

        $latestReviews = Transaksi::whereBetween('tgl', [$startDate, $endDate])
            ->whereNotNull('rating')
            ->where('rating', '>', 0)
            ->orderBy('tgl_rating', 'desc')
            ->select('id_trx', 'nama', 'rating', 'komentar_rating', 'tgl_rating')
            ->get();

        return view('admin.laporan.index', compact(
            'tgl_awal', 'tgl_akhir',
            'rekapKecKel', 'rekapDokumen', 'rekapStatus', 'rekapBulanan',
            'totalRatings', 'averageRating', 'starCounts', 'latestReviews'
        ));
    }

    private function getStatusBadgeClass($status)
    {
        $badgeMap = [
            1 => 'warning',      // Baru
            2 => 'secondary',    // Verifikasi
            3 => 'primary',      // Proses
            4 => 'success',      // Selesai
            5 => 'danger',       // Ditolak
            6 => 'info',         // Pengajuan Ulang
            7 => 'warning',      // Komplain
            8 => 'dark',         // Dibatalkan
        ];
        return $badgeMap[$status] ?? 'light';
    }

    private function formatIndoMonth($yearMonth)
    {
        if (empty($yearMonth)) return '-';
        $parts = explode('-', $yearMonth);
        if (count($parts) !== 2) return $yearMonth;
        
        $year = $parts[0];
        $month = (int)$parts[1];
        
        $months = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
        ];
        
        return ($months[$month] ?? '') . ' ' . $year;
    }
}
