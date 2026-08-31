<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Representasi dari pemateri/ustadz yang mengisi kajian.
 */
class Speaker extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'photo',
        'description',
    ];

    /**
     * Relasi ke daftar kajian yang diisi oleh pemateri ini.
     */
    public function kajians(): HasMany
    {
        return $this->hasMany(Kajian::class);
    }
}
