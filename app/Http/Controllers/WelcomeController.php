<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;

/**
 * Class WelcomeController
 *
 * @package App\Http\Controllers
 */
class WelcomeController extends Controller
{
    /**
     * Welcome page off the application.
     * ---
     * For now this is the login view because there is not really enough for creating a frontend website.
     *
     * @return Renderable
     */
    public function index(): Renderable
    {
        return view('auth.login');
    }
}
