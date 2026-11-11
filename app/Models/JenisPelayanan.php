<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisPelayanan extends Model
{
    use HasFactory;

    protected $table = 'jenis_pelayanan';
    
    // Sesuaikan fillable sesuai kolom yang ada di tabel Anda
    protected $fillable = ['nama', 'keterangan']; 
}
