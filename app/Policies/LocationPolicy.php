<?php

namespace App\Policies;

use App\Models\Location;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Class LocationPolicy
 *
 * @package App\Policies
 */
class LocationPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can update the location.
     *
     * @param  User      $user
     * @param  Location  $location
     * @return bool
     */
    public function update(User $user, Location $location): bool
    {
        return  $user->hasRole(['admin', 'webmaster']) || $user->is($location->coordinator);
    }


    /**
     * Determine whether the user can update the coordinator or not.
     *
     * @param  User     $user
     * @param  Location $location
     * @return bool
     */
    public function updateCoordinator(User $user, Location $location): bool
    {
        return $user->hasAnyRole(['admin', 'webmaster']);
    }
}
