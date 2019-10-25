<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use App\Http\Requests\Inventory\ItemFormRequest;
use App\Models\Category;
use App\Models\Item;
use App\Models\Location;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

/**
 * Class SharedController
 *
 * @package App\Http\Controllers\Inventory
 */
class SharedController extends Controller
{
    /**
     * SharedController constructor.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'forbid-banned-user']);
    }

    /**
     * Method for displaying the item information in the application.
     *
     * @todo Provide the update method function for the item information.
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException <- Triggers when the user is not permitted.
     *
     * @param  Item $item The resource entity from the given item.
     * @return Renderable
     */
    public function show(Item $item): Renderable
    {
        $this->authorize('show', $item);

        $locations  = Location::all();
        $categories = Category::all();

        return view('inventory.show', compact('item', 'locations', 'categories'));
    }

    public function update(ItemFormRequest $request, Item $item): RedirectResponse
    {

    }
}
