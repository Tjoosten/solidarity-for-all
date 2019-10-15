<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\UsersFormRequest;
use App\Notifications\LoginCreated;
use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

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
        $this->middleware(['auth', 'role:admin|webmaster'])->except('update');
        $this->middleware('can:update,userEntity')->only('update');
    }

    /**
     * Method for displaying all the users in the application.
     *
     * @param  User $users Database model entity for the users in the application.
     * @return Renderable
     */
    public function index(User $users): Renderable
    {
        return view('users.index', ['users' => $users->paginate()]);
    }

    /**
     * Method for displaying the user information from a given user.
     *
     * @param  User $user The database entity from the given user in the storage.
     * @return Renderable
     */
    public function show(User $user): Renderable
    {
        $roles = Role::all();
        return view('users.show', compact('user', 'roles'));
    }

    /**
     * Method for updating the account information from the user in the application.
     *
     * @param UsersFormRequest  $request     The form request class that handles the validation.
     * @param User              $userEntity  The resource entity from the given form.
     * @return RedirectResponse
     */
    public function update(UsersFormRequest $request, User $userEntity): RedirectResponse
    {
        DB::transaction(static function () use ($request, $userEntity): void {
            $userEntity->update($request->except('role'));
            $userEntity->syncRoles($request->role);

            flash("De gegevens van {$userEntity->name} zijn aangepast in de applicatie.");
        });

        return redirect()->route('users.show', $userEntity);
    }

    /**
     * Method for displaying the create view for an new user.
     *
     * @param  Role $roles The database model class for the application permissions.
     * @return Renderable
     */
    public function create(Role $roles): Renderable
    {
        // Duplicate pluck attribute because we assign the user
        // permission based on name so we have an name attribute
        // for the value and ne for display in the dropdown

        return view('users.create', ['roles' => $roles->pluck('name', 'name')]);
    }

    /**
     * Method for storing an new user in the application.
     *
     * @param  UsersFormRequest $request The form request class that handles all the validation.
     * @param  User             $user    The entity form the user database model class.
     * @return RedirectResponse
     */
    public function store(UsersFormRequest $request, User $user): RedirectResponse
    {
        $request->merge(['password' => Str::random(16)]);

        $user = DB::transaction(static function () use ($request, $user): User {
            $user = $user->create($request->all());
            $user->syncRoles($request->role);
            $user->notify((new LoginCreated($request->all()))->delay(now()->addMinute()));

            return $user;
        });

        return redirect()->route('users.show', $user);
    }
}
