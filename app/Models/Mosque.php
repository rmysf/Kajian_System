<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Representasi dari entitas masjid sebagai lokasi pelaksanaan kajian.
 */
class Mosque extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'organizer_id',
        'name',
        'address',
        'latitude',
        'longitude',
        'google_maps_url',
        'photo',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'latitude' => 'decimal:7',
        'longitude' => 'decimal:7',
    ];

    /**
     * Relasi ke organizer yang menaungi atau mendaftarkan masjid ini.
     */
    public function organizer(): BelongsTo
    {
        return $this->belongsTo(Organizer::class);
    }

    /**
     * Relasi ke daftar kajian yang diselenggarakan di masjid ini.
     */
    public function kajians(): HasMany
    {
        return $this->hasMany(Kajian::class);
    }
}
