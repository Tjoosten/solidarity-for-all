<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use App\Http\Requests\Inventory\CheckInFormRequest;
use App\Models\Item;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Class CheckoutController
 *
 * @package App\Http\Controllers\Inventory
 */
class CheckoutController extends Controller
{
    /**
     * CheckoutController constructor.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'forbid-banned-user', 'can:checkout,item']);
    }

    /**
     * Method for remove item quantities out off the application.
     *
     * @param  Item $item The resouce entity from the given item.
     * @return Renderable
     */
    public function create(Item $item): Renderable
    {
        return view('inventory.states.checkout', compact('item'));
    }


    /**
     * Method for removing the given item quantities in the application.
     *
     * @param  CheckInFormRequest $request The form request class that handles the form validation.
     * @param  Item               $item    The resource entity from the given item.
     * @return RedirectResponse
     */
    public function store(CheckInFormRequest $request, Item $item): RedirectResponse
    {
        DB::transaction(static function () use ($request, $item) {
            $item->decrement('quantity', $request->quantity);

            if ($request->note === null) {
                $request->merge(['note' => "Heeft {$request->quantity} stukt uitgeboekt bij het item {$item->name}"]);
            }

            activity('inventaris')->performedOn($item)->withProperties(['type' => 'ingeboekt'])->log($request->note);
            flash("Er zijn {$request->quantity} stuks uitgeboekt van het volgende item: {$item->name}");
        });

        return back(); // Redirect the user back to the previous page.
    }
}
