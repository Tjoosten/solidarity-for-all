<?php

namespace App\Http\Controllers\Locations;

use App\Http\Controllers\Controller;
use App\Models\Location;
use App\Models\User;
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

    /**
     * Method for displaying the create view for an new collection point. (location)
     *
     * @param  User $users The database model class for the users in the application.
     * @return Renderable
     */
    public function create(User $users): Renderable
    {
        $users = $users->role('vrijwilliger')->doesnthave('location')->pluck('name', 'id');
        return view('locations.create', compact('users'));
    }
}
