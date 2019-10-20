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
        // The update method is excluded because the volunteer that a the coordinator.
        // Form the collection is also needed to update the information. So
        // It is better to pass a authorization policy to the controller function.
        $this->middleware('can:update,location')->only('update');


        $this->middleware(['auth', 'forbid-banned-user', 'role:admin|webmaster'])
            ->except('update');
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
     * Display the given collection point in the application.
     *
     * @param  Location $location The resource entity from the given collection point.
     * @return Renderable
     */
    public function show(Location $location): Renderable
    {
        $users = User::role('vrijwilliger')->doesntHave('location')->pluck('name', 'id');
        return view('locations.show', compact('location', 'users'));
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

    /**
     * Method for updating the collection point (location) in the application.
     *
     * @todo Implement update-coordinator policy
     *
     * @param  LocationFormRequest $request     The request class that handles the validation
     * @param  Location            $location    The resource entity from the given collection point (location)
     * @return RedirectResponse
     */
    public function update(LocationFormRequest $request, Location $location): RedirectResponse
    {
        DB::transaction(static function () use ($request, $location): void {
            if ($request->user()->can('update-coordinator', $location)) {
                $location->coordinator()->associate($request->coordinator)->save();
            }

            $location->update($request->except('coordinator'));
            flash('De gegevens omtrent het inzamelpunt zijn aangepast.');
        });

        return redirect()->route('locations.show', $location);
    }
}
