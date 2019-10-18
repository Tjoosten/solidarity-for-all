<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    /**
     * Data relation for all the stuff that is attached to the collection point. (Location)
     *
     * @return HasMany
     */
    public function items(): HasMany
    {
        return $this->hasMany(Item::class);
    }

    /**
     * Attribute setter to combne various data pieces to the full address.
     *
     * @return string
     */
    public function getFullAddressAttribute(): string
    {
        return "{$this->address}, {$this->postal} {$this->city}";
    }
}
