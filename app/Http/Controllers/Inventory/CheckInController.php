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
 * Class CheckInController
 *
 * @package App\Http\Controllers\Inventory
 */
class CheckInController extends Controller
{
    /**
     * CheckInController constructor.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'forbid-banned-user', 'can:checkin,item']);
    }

    /**
     * Method for display the view where users can checkin new items in the inventory.
     *
     * @param Item $item The resource entoty from the given item.
     * @return Renderable
     */
    public function create(Item $item): Renderable
    {
        return view('inventory.states.checkin', compact('item'));
    }

    /**
     * Method for checking in item quantities in the application.
     *
     * @param  CheckInFormRequest $request  The form request class that handles validation.
     * @param  Item               $item     The resource entity from given item.
     * @return RedirectResponse
     */
    public function store(CheckInFormRequest $request, Item $item): RedirectResponse
    {
        DB::transaction(static function () use ($request, $item): void {
            $item->increment('quantity', $request->quantity);

            if ($request->note === null) {
                $request->merge(['note' => "Heeft {$request->quantity} stuks ingeboekt bij het item {$item->name}"]);
            }

            activity('inventaris')->performedOn($item)->withProperties(['type' => 'ingeboekt'])->log($request->note);
            flash("Er zijn {$request->quantity} stuks ingeboeks van het volgende item: {$item->name}");
        });

        return back(); // Redirect the user back to the previous page.
    }
}
