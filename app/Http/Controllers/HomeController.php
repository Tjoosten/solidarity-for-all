<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Traits\DashboardCountable;
use Spatie\Activitylog\Models\Activity;

/**
 * Class HomeController
 *
 * @package App\Http\Controllers
 */
class HomeController extends Controller
{
    use DashboardCountable;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'role:admin|webmaster', 'forbid-banned-user'])->only('index');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users        = $this->getUserWidgetCounters();
        $items        = $this->getItemWidgetCounters();
        $categories   = $this->getCategoryWidgetCounter();
        $locations    = $this->getLocationsWidgetCounters();
        $interactions = Activity::where('log_name', 'Inventaris')->latest()->take(10)->get();
        $products     = Item::latest()->take(10)->get();

        return view('home', compact('products', 'users', 'items', 'categories', 'locations', 'interactions'));
    }
}
