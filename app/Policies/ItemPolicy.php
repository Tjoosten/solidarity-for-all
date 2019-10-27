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
     * Determine whether the user can view the item information or not.
     *
     * @param  User $user   The resource entity from the authenticated user.
     * @param  Item $item   The given resource entity from the item.
     * @return bool
     */
    public function show(User $user, Item $item): bool
    {
        return $user->hasAnyRole(['admin', 'webmaster']) || $user->location->is($item->location);
    }

    /**
     * Determine whether the user can delete an inventory item or not.
     *
     * @param  User $user   The resource entity from the authenticated user.
     * @param  Item $item   The resource entity from the given item.
     * @return bool
     */
    public function destroy(User $user, Item $item): bool
    {
        return $user->hasAnyRole(['admin', 'webmaster']) || $user->location->is($item->location);
    }

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
     * Determine whether the user can update the item information or not.
     *
     * @param  User $user   The resource entity from the authenticated user.
     * @param  Item $item   The resource entity from the given item.
     * @return bool
     */
    public function update(User $user, Item $item): bool
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
