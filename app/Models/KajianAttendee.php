<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Representasi dari data pendaftaran atau kehadiran seorang user pada suatu kajian.
 */
class KajianAttendee extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'kajian_id',
        'user_id',
        'status',
        'checked_in_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'checked_in_at' => 'datetime',
    ];

    /**
     * Relasi ke user (jamaah) yang mendaftar.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke kajian yang didaftar oleh user.
     */
    public function kajian(): BelongsTo
    {
        return $this->belongsTo(Kajian::class);
    }
}
