<?php

namespace App\Models\Relations;

use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Trait Creatorable
 *
 * @package App\Models\Relations
 */
trait Creatorable
{
    /**
     * Data relation for the creator of the resource entity.
     *
     * @return BelongsTo
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class)->withDefault(['name' => config('app.name')]);
    }

    /**
     * @param  User $creator    The database entity from the user who created the resource.
     * @return $this
     */
    public function setCreator(User $creator): self
    {
        $this->creator()->associate($creator)->save();
        return $this;
    }
}
