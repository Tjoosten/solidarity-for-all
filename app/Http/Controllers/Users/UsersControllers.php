<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Contracts\Support\Renderable;

/**
 * Class UsersControllers
 *
 * @package App\Http\Controllers\Users
 */
class UsersControllers extends Controller
{
    /**
     * UsersControllers constructor.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'role:admin,webmaster']);
    }

    /**
     * Method for displaying all the users in the application.
     *
     * @param  User $users Database model entity for the users in the application.
     * @return Renderable
     */
    public function index(User $users): Renderable
    {
        $users = $users->paginate();
        return view('users.index', compact('users'));
    }
}
