<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use App\Http\Requests\Inventory\CheckInFormRequest;
use App\Models\Item;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

/**
 * Class CheckInController
 *
 * @package App\Http\Controllers\Inventory
 */
class CheckInController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'forbid-banned-user', 'can:check-in,item']);
    }

    /**
     * Method for display the view where users can checkin new items in the inventory.
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException <- occurs when the user is not permitted
     *
     * @param Item $item The resource entoty from the given item.
     * @return Renderable
     */
    public function create(Item $item): Renderable
    {
        $this->authorize('checkin', $item);
        return view('inventory.states.checkin', compact('item'));
    }

    /**
     * @param  CheckInFormRequest $request
     * @param  Item $item
     * @return RedirectResponse
     */
    public function store(CheckInFormRequest $request, Item $item): RedirectResponse
    {

    }
}
