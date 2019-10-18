<?php

namespace App\Http\Controllers\Locations;

use App\Http\Controllers\Controller;
use App\Http\Requests\LocationFormRequest;
use App\Models\Location;
use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

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
        return view('locations.index', ['locations' => $locations->withCount('items')->paginate()]);
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

    /**
     * Method for storing an new collection point (location) in the application.
     *
     * @param  LocationFormRequest  $request    The form request class that handles all the validation.
     * @param  Location             $location   The database model for the collection points.
     * @return RedirectResponse
     */
    public function store(LocationFormRequest $request, Location $location): RedirectResponse
    {
        DB::transaction(static function () use ($request, $location): void {
            $location = new $location($request->except('coordinator'));

            $user = User::findOrFail($request->coordinator);
            $user->location()->save($location);

            flash('Het inzamelpunt is opgeslagen in de applicatie.')->success();
        });

        return redirect()->route('locations.index');
    }
}
