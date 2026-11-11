<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'nik',
        'kk',
        'phone',
        'role_id',
        'id_kec',
        'kode_desa',
        'active',
        'photos',
        'activation_code',
        'activation_code_expires_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // ✅ Relasi ke Kecamatan
    public function kecamatan()
    {
        return $this->belongsTo(SetupKec::class, 'id_kec', 'id');
    }

    // ✅ Relasi ke Desa/Kelurahan
    public function desa()
    {
        return $this->belongsTo(SetupKel::class, 'kode_desa', 'kode_desa');
    }

    public function getDesaAttribute()
    {
        if ($this->relationLoaded('desa')) {
            $loaded = $this->getRelation('desa');
            if ($loaded && $loaded->kecamatan_id == $this->id_kec && $loaded->kode_desa == $this->kode_desa) {
                return $loaded;
            }
        }

        return SetupKel::where('kode_desa', $this->kode_desa)
                       ->where('kecamatan_id', $this->id_kec)
                       ->first();
    }

    public function getLevelNameAttribute()
    {
        $levels = [
            1 => 'Admin',
            2 => 'User',
            3 => 'Verifikator',
            4 => 'Operator',
        ];

        return $levels[$this->role_id] ?? 'Tidak Diketahui';
    }

    public function getAvatarUrlAttribute()
    {
        if ($this->photos) {
            if (str_starts_with($this->photos, 'photos/')) {
                return route('dokumen.show', ['path' => $this->photos]);
            }
            return route('dokumen.show', ['path' => 'photos/' . $this->photos]);
        }
        // Avatar default jika tidak ada foto
        return 'https://ui-avatars.com/api/?name=' . urlencode($this->name) . '&color=7F9CF5&background=EBF4FF';
    }
}