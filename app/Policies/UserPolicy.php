<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Class UserPolicy
 *
 * @package App\Policies
 */
class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can update the model.
     *
     * @param  User $user   Resource entity form the authenticated user.
     * @param  User $model  Resource entity from the given user.
     * @return bool
     */
    public function update(User $user, User $model): bool
    {
        return $model->isNot($user) && $user->hasRole('webmaster');
    }
}
