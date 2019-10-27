<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Cache;
use Spatie\Permission\Traits\HasRoles;
use Cog\Contracts\Ban\Bannable as BannableContract;
use Cog\Laravel\Ban\Traits\Bannable;

/**
 * Class User
 *
 * @package App
 */
class User extends Authenticatable implements BannableContract
{
    use Notifiable, HasRoles, Bannable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password', 'phone_number'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['email_verified_at' => 'datetime'];

    /**
     * Method for hashing the given password in the application storage.
     *
     * @param  string $password The given or generated password from the application/form
     * @return void
     */
    public function setPasswordAttribute(string $password): void
    {
        $this->attributes['password'] = bcrypt($password);
    }

    /**
     * Method for getting the search based on the user given term.
     *
     * @param  string|null $term The user given term.
     * @return Builder
     */
    public function getSearchResults(?string $term): Builder
    {
        return $this->where('name', 'LIKE', "%{$term}%")
            ->orWhere('email', 'LIKE', "%{$term}%")
            ->orWhere('phone_number', "%{$term}%");
    }

    /**
     * Data relation for the location where the user is responsible for.
     *
     * Locations = collection points for items like clothing and other things
     * that can be given to refugee's or other population groups that are in need.
     *
     * @return HasOne
     */
    public function location(): HasOne
    {
        return $this->hasOne(Location::class, 'coordinator_id')
            ->withDefault(['name' => config('app.name')]);
    }

    /**
     * Method for tracking that the user is online or not.
     *
     * @return bool
     */
    public function isOnline(): bool
    {
        return Cache::has('user-is-online-' . $this->id);
    }
}
