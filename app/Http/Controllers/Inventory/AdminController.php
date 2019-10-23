<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use App\Http\Requests\Inventory\ItemFormRequest;
use App\Models\Category;
use App\Models\Item;
use App\Models\Location;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

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

    /**
     * Method for storing a new item in the application.
     *
     * @throws \Exception <- When an unexpected error occurs
     *
     * @todo Complete validation
     *
     * @param ItemFormRequest $request The request class that handles all the validation logic.
     * @param Item $item The database model for the inventory items.
     * @return RedirectResponse
     */
    public function store(ItemFormRequest $request, Item $item): RedirectResponse
    {
        $request->merge(['item_code' => $item->generateItemCode()]);

        DB::transaction(static function () use ($request, $item) {
            $item = $item->create($request->except(['category', 'location']));
            $item->location()->associate($request->location)->save();
            $item->category()->associate($request->category)->save();

            flash(ucfirst($item->name) . ' is toegevoegd in de applicatie');
        });

        return redirect()->route('inventory.admin.index');
    }
}
