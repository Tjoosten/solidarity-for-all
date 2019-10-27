<?php

namespace App\Http\Controllers\Locations;

use App\Http\Controllers\Controller;
use App\Models\Location;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;

/**
 * Class InventoryController
 *
 * @package App\Http\Controllers\Locations
 */
class InventoryController extends Controller
{
    /**
     * InventoryController constructor.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'role:admin|webmaster', 'forbid-banned-user']);
    }

    /**
     * Method for displaying all the items that are located in the given location.
     *
     * @param  Location $location The resource entity from the given location.
     * @return Renderable
     */
    public function index(Location $location): Renderable
    {
        $items = $location->items()->paginate();
        return view('locations.inventory.index', compact('items', 'location'));
    }
}
