<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSyarat extends Model
{
    use HasFactory;

    protected $table = 'user_syarat';
    protected $fillable = ['id_trx', 'file'];

    // Menonaktifkan timestamps karena kolom tidak ada di tabel
    public $timestamps = false;

    // Relasi
    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'id_trx');
    }
}
