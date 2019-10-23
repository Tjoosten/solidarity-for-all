<?php

namespace App\Policies;

use App\Models\Item;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Class ItemPolicy
 *
 * @package App\Policies
 */
class ItemPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can check-in new items or not.
     *
     * @param  User $user   The resource entity from the authenticated user.
     * @param  Item $item   The given resource entity from the item.
     * @return bool
     */
    public function checkin(User $user, Item $item): bool
    {
        return $user->hasAnyRole(['admin', 'webmaster']) || $item->location->is($user->location);
    }

    /**
     * Determine whether the user can checkout items or not.
     *
     * @param  User $user   The resource entity from the authenticated user.
     * @param  Item $item   The given resource entity from the item.
     * @return bool
     */
    public function checkout(User $user, Item $item): bool
    {
        return $user->hasAnyRole(['admin', 'webmaster']) || $item->location->is($user->location);
    }
}
