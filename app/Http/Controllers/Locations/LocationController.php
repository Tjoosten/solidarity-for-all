<?php

namespace App\Http\Controllers\Locations;

use App\Http\Controllers\Controller;
use App\Models\Location;
use Illuminate\Contracts\Support\Renderable;

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
        $this->middleware(['auth', 'forbid-banned-user', 'role:admin|webmaster']);
    }

    /**
     * Method for listing all the collection points in the application. (locations)
     *
     * @param  Location $locations   The database model for all the location in the application.
     * @return Renderable
     */
    public function index(Location $locations): Renderable
    {
        return view('locations.index', ['locations' => $locations->paginate()]);
    }
}
