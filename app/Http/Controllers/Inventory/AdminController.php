<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Item;
use App\Models\Location;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;

/**
 * Class AdminController
 *
 * @package App\Http\Controllers\Inventory
 */
class AdminController extends Controller
{
    /**
     * AdminController constructor.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'role:admin|webmaster', 'forbid-banned-user']);
    }

    /**
     * Method for displaying all the inventory items in the application.
     *
     * @param  Item $items  The database model class for all the items in the application
     * @return Renderable
     */
    public function index(Item $items): Renderable
    {
        $items = $items->paginate();
        return view('inventory.index', compact('items'));
    }

    /**
     * Method for creating a new items in the application.
     *
     * @return Renderable
     */
    public function create(): Renderable
    {
        $locations  = Location::pluck('name', 'id');
        $categories = Category::pluck('name', 'id');

        return view('inventory.create', compact('locations', 'categories'));
    }

    public function store(): RedirectResponse
    {

    }
}
