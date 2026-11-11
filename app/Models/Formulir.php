<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formulir extends Model
{
    use HasFactory;

    // Menentukan secara eksplisit nama tabel yang benar
    protected $table = 'formulir';

    // Tabel ini tidak memiliki kolom timestamps (created_at & updated_at)
    public $timestamps = false;

    /**
     * Atribut yang dapat diisi secara massal (mass assignable).
     *
     * @var array
     */
    protected $fillable = [
        'jenis_formulir',
        'keterangan',
        'ket',
        'dokumen',
        'aktif',
    ];

    /**
     * Accessor untuk keterangan (memetakan ke kolom 'ket')
     */
    public function getKeteranganAttribute()
    {
        return $this->attributes['ket'] ?? null;
    }

    /**
     * Mutator untuk keterangan (memetakan ke kolom 'ket')
     */
    public function setKeteranganAttribute($value)
    {
        $this->attributes['ket'] = $value;
    }
}