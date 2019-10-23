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

    public function create(Item $item): Renderable
    {

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
