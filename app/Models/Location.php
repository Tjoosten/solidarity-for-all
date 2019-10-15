<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Location
 *
 * @package App\Models
 */
class Location extends Model
{
    /**
     * Protected fields for the internal mass-assignment system.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * Data relation for the user information from the coordinator off this collection point (location).
     *
     * @return BelongsTo
     */
    public function coordinator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'coordinator_id');
    }
}
