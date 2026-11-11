<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PersyaratanUmum extends Model
{
    protected $table = 'persyaratan_umum';

    protected $fillable = [
        'layanan',
        'deskripsi_syarat',
        'deskripsi_output'
    ];
}
