<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Representasi dari data kajian yang difavoritkan atau disimpan oleh user.
 */
class Favorite extends Model
{
    /**
     * Disable updated_at timestamp since we only have created_at.
     */
    const UPDATED_AT = null;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
        'kajian_id',
    ];

    /**
     * Relasi ke user yang memfavoritkan kajian.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke kajian yang difavoritkan.
     */
    public function kajian(): BelongsTo
    {
        return $this->belongsTo(Kajian::class);
    }
}
