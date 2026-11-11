<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;

class UserLegacy extends Model implements Authenticatable
{
    use HasFactory, AuthenticatableTrait;

    protected $table = 'users';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $hidden = [
        'password',
        'remember_code',
    ];

    public function getAvatarUrlAttribute()
    {
        if ($this->photos) {
            if (str_starts_with($this->photos, 'photos/')) {
                return route('dokumen.show', ['path' => $this->photos]);
            }
            return route('dokumen.show', ['path' => 'photos/' . $this->photos]);
        }
        return 'https://ui-avatars.com/api/?name=' . urlencode($this->name) . '&color=7F9CF5&background=EBF4FF';
    }

}
