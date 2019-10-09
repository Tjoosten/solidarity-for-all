<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Profile\SecurityFormRequest;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

/**
 * Class SecurityController
 *
 * @package App\Http\Controllers\Profile
 */
class SecurityController extends Controller
{
    /** @var Guard $auth */
    protected $auth;

    /**
     * SecurityController constructor.
     *
     * @param  Guard $auth
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
        $this->middleware('auth');
    }

    /**
     * Method to display the security settings view.
     *
     * @return Renderable
     */
    public function index(): Renderable
    {
        return view('profile.security');
    }

    /**
     * Method for updating the account security from the authenticated user.
     *
     * @param  SecurityFormRequest $request
     * @return RedirectResponse
     */
    public function update(SecurityFormRequest $request): RedirectResponse
    {
        if ($this->auth->user()->update($request->except('old_password'))) {
            flash('Uw Account beveiliging is met succes aangepast');
        }

        return redirect()->route('profile.settings.security');
    }
}
