<?php

namespace App\Http\Controllers\Locations;

use App\Http\Controllers\Controller;

/**
 * Class LocationController
 *
 * @package App\Http\Controllers\Locations
 */
class LocationController extends Controller
{
    /**
     * LocationController constructor.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'forbid-banned-user']);
    }
}
