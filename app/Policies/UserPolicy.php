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
     * @param  User $user   Resource entity from the authenticated user.
     * @param  User $model  Resource entity from the given user.
     * @return bool
     */
    public function update(User $user, User $model): bool
    {
        return $model->isNot($user) && $user->hasRole('webmaster');
    }

    /**
     * Determine whether the user can deactivate a user in the application.
     *
     * @param  User $user   Resource entity from the authenticated user.
     * @param  User $model  Resource entity from the given user.
     * @return bool
     */
    public function deactivate(User $user, User $model): bool
    {
        return $model->isNotBanned() && $user->isNot($model) && $user->hasAnyRole(['admin', 'webmaster']);
    }

    /**
     * Deteminer whether the user an activate the user after a deactivation or not.
     *
     * @param  User $user   Resource entity from the authenticated user.
     * @param  User $model  resource entity from the given user.
     * @return bool
     */
    public function activate(User $user, User $model): bool
    {
        return $model->isBanned() && $user->isNot($model) &&    $user->hasAnyRole(['admin', 'webmaster']);
    }
}
