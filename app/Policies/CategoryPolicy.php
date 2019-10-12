<?php

namespace App\Policies;

use App\Models\Category;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Class CategoryPolicy
 *
 * @package App\Policies
 */
class CategoryPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can permanently delete the category.
     *
     * @param  User $user   Entity form the authenticated user.
     * @return bool
     */
    public function delete(User $user): bool
    {
        return $user->hasAnyRole(['admin', 'webmaster']);
    }
}
