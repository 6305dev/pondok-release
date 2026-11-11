<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\User;
use App\Models\JenisPelayanan;
use App\Models\Pengambilan;
use App\Models\UserSyarat;
use App\Models\UserDokumen;

class Transaksi extends Model
{
    protected $table = 'transaksi';
    protected $primaryKey = 'id_trx';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_trx', 'id_user', 'nik', 'kk', 'nama',
        'id_dokumen', 'pengambilan_id', 'keterangan', 'tgl', 'status',
        'id_kec', 'id_kel', 'tgl_respon', 'tgl_proses', 'tgl_selesai', 
        'konfirmasi', 'tgl_konfirmasi', 'pesan', 'alasan',
        'rating', 'komentar_rating', 'tgl_rating',
        'selfie_path',
        'signature_path',
    ];
    protected $casts = [
        'tgl' => 'datetime',
        'tgl_respon' => 'datetime',
        'tgl_proses' => 'datetime',
        'tgl_selesai' => 'datetime',
        'tgl_konfirmasi' => 'datetime',
        'tgl_rating' => 'datetime',
        // 'id_dokumen' => 'array',
    ];

    /**
     * Generate ID transaksi unik dengan format PDK-dmy-NNN.
     * Dipakai PengajuanController saat membuat transaksi baru.
     */
    public function generateIdTrx(): string
    {
        $prefix = 'PDK-' . now()->format('dmy') . '-';

        $lastTrx = static::where('id_trx', 'like', $prefix . '%')
            ->orderBy('id_trx', 'desc')
            ->lockForUpdate()
            ->first();

        $nextNumber = $lastTrx ? ((int) substr($lastTrx->id_trx, -3)) + 1 : 1;

        return $prefix . str_pad((string) $nextNumber, 3, '0', STR_PAD_LEFT);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function kecamatan(): BelongsTo
    {
        return $this->belongsTo(SetupKec::class, 'id_kec', 'id');
    }

    public function desa(): BelongsTo
    {
        return $this->belongsTo(SetupKel::class, 'id_kel', 'kode_desa');
    }

    public function getDesaAttribute()
    {
        if ($this->relationLoaded('desa')) {
            $loaded = $this->getRelation('desa');
            if ($loaded && $loaded->kecamatan_id == $this->id_kec && $loaded->kode_desa == $this->id_kel) {
                return $loaded;
            }
        }

        return SetupKel::where('kode_desa', $this->id_kel)
                       ->where('kecamatan_id', $this->id_kec)
                       ->first();
    }

    public function dokumen(): BelongsTo
    {
        return $this->belongsTo(JenisPelayanan::class, 'id_dokumen', 'id'); 
    }

    public function pengambilan(): BelongsTo
    {
        return $this->belongsTo(Pengambilan::class, 'pengambilan_id', 'id');
    }

    public function files(): HasMany
    {
        return $this->hasMany(UserSyarat::class, 'id_trx', 'id_trx');
    }

    public function jenisPelayanan()
    {
        return $this->belongsTo(JenisPelayanan::class, 'id_dokumen', 'id');
    }

    public function userDokumen()
    {
        return $this->hasMany(UserDokumen::class, 'id_trx', 'id_trx');
    }

    // ✅ Accessor: URL publik untuk selfie
    public function getSelfieUrlAttribute()
    {
        return $this->selfie_path 
            ? route('dokumen.show', ['path' => $this->selfie_path]) 
            : null;
    }

    // ✅ Accessor: URL publik untuk signature
    public function getSignatureUrlAttribute()
    {
        return $this->signature_path 
            ? route('dokumen.show', ['path' => $this->signature_path]) 
            : null;
    }

    // ✅ Accessor: apakah selfie & signature sudah ada?
    public function getHasSelfieAttribute()
    {
        return !empty($this->selfie_path);
    }

    public function getHasSignatureAttribute()
    {
        return !empty($this->signature_path);
    }

    // ✅ Konstanta & accessor status (tetap sama)
    public const STATUS_BARU = 1;
    public const STATUS_VERIFIKASI = 2;
    public const STATUS_PROSES = 3;
    public const STATUS_SELESAI = 4;
    public const STATUS_DITOLAK = 5;
    public const STATUS_AJUKAN_ULANG = 6;
    public const STATUS_KOMPLAIN = 7;
    public const STATUS_DIBATALKAN = 8;

    public static function statusLabels()
    {
        return [
            self::STATUS_BARU => 'Baru',
            self::STATUS_VERIFIKASI => 'Verifikasi',
            self::STATUS_PROSES => 'Proses',
            self::STATUS_SELESAI => 'Selesai',
            self::STATUS_DITOLAK => 'Ditolak',
            self::STATUS_AJUKAN_ULANG => 'Pengajuan Ulang',
            self::STATUS_KOMPLAIN => 'Komplain',
            self::STATUS_DIBATALKAN => 'Dibatalkan',
        ];
    }

    public function getStatusLabelAttribute()
    {
        return self::statusLabels()[$this->status] ?? 'Tidak Diketahui';
    }

    public function getStatusBadgeClassAttribute()
    {
        $badgeMap = [
            self::STATUS_BARU => 'badge-warning',
            self::STATUS_VERIFIKASI => 'badge-secondary',
            self::STATUS_PROSES => 'badge-primary',
            self::STATUS_SELESAI => 'badge-success',
            self::STATUS_DITOLAK => 'badge-danger',
            self::STATUS_AJUKAN_ULANG => 'badge-secondary',
            self::STATUS_KOMPLAIN => 'badge-danger',
            self::STATUS_DIBATALKAN => 'badge-danger',
        ];
        return $badgeMap[$this->status] ?? 'badge-light';
    }

    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }
}