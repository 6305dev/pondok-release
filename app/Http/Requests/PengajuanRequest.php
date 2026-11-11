<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PengajuanRequest extends FormRequest
{
    /**
     * Tentukan apakah user berhak melakukan request ini.
     * @return bool
     */
    public function authorize()
    {
        // Ganti 'false' dengan logika otorisasi yang sesuai
        // Misalnya: return auth()->check();
        return true; 
    }

    /**
     * Dapatkan aturan validasi yang berlaku untuk request.
     * @return array
     */
    public function rules()
    {
        return [
            'nik' => 'required|digits:16',
            'kk' => 'required|digits:16',
            'nama' => 'required|string|max:255',
            'jenis_layanan' => 'required|exists:jenis_pelayanan,id',
            'isi_informasi' => 'required|string',
            'keterangan' => 'required|string', // dari hidden input
            // 'id_dokumen' => 'nullable|string', // opsional
            'pengambilan_id' => 'required|exists:pengambilan,id', // pastikan nama field ini!
        ];
    }
}
