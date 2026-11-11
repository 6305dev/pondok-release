<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserDokumen extends Model
{
    use SoftDeletes;

    protected $table = 'user_dokumen';

    protected $fillable = [
        'user_id',
        'id_trx',
        'nama_dokumen',
        'file_path',
        'keterangan',
    ];

    protected $dates = ['deleted_at'];

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'id_trx', 'id_trx');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
