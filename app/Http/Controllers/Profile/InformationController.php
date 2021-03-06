<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Profile\InformationFormRequest;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;

/**
 * Class InformationController
 *
 * @package App\Http\Controllers\Profile
 */
class InformationController extends Controller
{
    /**  @var Guard $auth */
    protected $auth;

    /**
     * InformationController constructor.
     *
     * @param  Guard $auth
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
        $this->middleware(['auth', 'forbid-banned-user']);
    }

    /**
     * Method to display the page where the user can change his information settings.
     *
     * @return Renderable
     */
    public function index(): Renderable
    {
        return view('profile.information');
    }

    /**
     * Method for updating the information settings for the user.
     *
     * @param  InformationFormRequest $request
     * @return RedirectResponse
     */
    public function update(InformationFormRequest $request): RedirectResponse
    {
        if ($this->auth->user()->update($request->all())) {
            flash('Uw algemene gegevens zijn met succes aangepast.');
        }

        return redirect()->route('profile.settings.info');
    }
}
