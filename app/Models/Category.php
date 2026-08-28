<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Representasi dari kategori atau tema kajian (contoh: Fiqih, Aqidah).
 */
class Category extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'slug',
    ];

    /**
     * Relasi ke daftar kajian yang termasuk dalam kategori ini.
     */
    public function kajians(): HasMany
    {
        return $this->hasMany(Kajian::class);
    }

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
