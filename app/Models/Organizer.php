<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Representasi dari penyelenggara kajian (yayasan/lembaga).
 */
class Organizer extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
        'name',
        'description',
        'phone',
        'logo',
        'address',
        'latitude',
        'longitude',
        'is_verified',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'latitude' => 'decimal:7',
        'longitude' => 'decimal:7',
        'is_verified' => 'boolean',
    ];

    /**
     * Relasi ke user pengelola (akun) dari organizer ini.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke masjid-masjid yang dikelola oleh organizer ini.
     */
    public function mosques(): HasMany
    {
        return $this->hasMany(Mosque::class);
    }

    /**
     * Relasi ke kajian-kajian yang diselenggarakan oleh organizer ini.
     */
    public function kajians(): HasMany
    {
        return $this->hasMany(Kajian::class);
    }
}
