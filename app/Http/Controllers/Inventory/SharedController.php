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
use Illuminate\Support\Facades\DB;

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
     * @throws \Illuminate\Auth\Access\AuthorizationException <- Triggers when the user is not permitted.
     *
     * @param  Item $item The resource entity from the given item.
     * @return Renderable
     */
    public function show(Item $item): Renderable
    {
        $this->authorize('show', $item);
        $categories = Category::all();

        return view('inventory.show', compact('item', 'categories'));
    }

    /**
     * Method for updating item information in the application.
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException <- triggered when the usr is not authorized.
     *
     * @param ItemFormRequest $request The form request class that handles the validation.
     * @param Item $item The resource entity from the given item.
     * @return RedirectResponse
     */
    public function update(ItemFormRequest $request, Item $item): RedirectResponse
    {
        $this->authorize('update', $item);

        DB::transaction(static function () use ($request, $item): void {
            $item->update($request->except('category'));
            $item->category()->associate($request->category)->save();

            flash("De item gegevens van {$item->name} zijn met success aangepast");
        });

        return redirect()->route('inventory.show', $item); // Update complete so redirect the user back to the previous page.
    }
}
