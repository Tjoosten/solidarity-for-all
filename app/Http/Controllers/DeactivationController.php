<?php

namespace App\Http\Controllers;

use App\Http\Requests\DeactivateFormRequest;
use App\Models\User;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

/**
 * Class DeactivationController
 *
 * @package App\Http\Controllers
 */
class DeactivationController extends Controller
{
    /**
     * The authentication guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * DeactivationController constructor.
     *
     * @param  Guard $auth The guard implementation variable.
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->middleware('auth');
        $this->middleware(['forbid-banned-user', 'password.confirm'])->except('show');

        $this->auth = $auth;
    }

    /**
     * Method for displaying the deactivation view.
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException <- Triggers when the user is not permitted.
     *
     * @param User $user The resource entity from the given user in the application.
     * @return Renderable
     */
    public function index(User $user): Renderable
    {
        $this->authorize('deactivate', $user);
        return view('users.deactivate', compact('user'));
    }

    /**
     * Method for displaying the view when the authenticated user is deactivated.
     *
     * @return Renderable
     */
    public function show(): Renderable
    {
        $user = $this->auth->user();

        if ($user && $user->isBanned()) { // Check if the user is actually banned in the application.
            $banInfo = $user->bans()->latest()->first();
            return view('errors.deactivated', compact('banInfo'));
        }

        // The authenticated user is not deactivated in the application.
        // So there is no deactivation view to be displayed.
        return abort(Response::HTTP_NOT_FOUND); // HTTP/2 404 - NOT FOUND.
    }

    /**
     * Method for storing the deactivation in the application.
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException <- Triggers when the user is not permitted.
     *
     * @param DeactivateFormRequest $request The request class that handles the validation logic.
     * @param User $user The resource entity from the given user.
     * @return RedirectResponse
     */
    public function store(DeactivateFormRequest $request, User $user): RedirectResponse
    {
        $this->authorize('deactivate', $user);

        DB::transaction(static function () use ($request, $user): void {
            $user->ban(['comment' => $request->reden]);
            // TODO: *can wait*: Implement email notification.
        });

        return route()->redirect('users.show', $user);
    }

    /**
     * Method for deleting the account deactivation in the application.
     *
     * @param  User $user   The resource entity from the given user.
     * @return RedirectResponse
     */
    public function destroy(User $user): RedirectResponse
    {
        //
    }
}
