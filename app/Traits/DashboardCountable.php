<?php

namespace App\Traits;

use App\Models\Location;
use Illuminate\Support\Facades\DB;
use stdClass;

/**
 * Trait DashboardCountable
 *
 * @package App\Traits
 */
trait DashboardCountable
{
    /**
     * Method for getting al the user counters that the dashboard needs.
     *
     * @return stdClass
     */
    public function getUserWidgetCounters(): stdClass
    {
        return DB::table('users')
            ->selectRaw('count(*) as total')
            ->selectRaw('count(case when banned_at is not null then 1 end) as deactivated_count')
            ->first();
    }

    /**
     * Method for getting all the item counters that the dashboard needs.
     *
     * @return stdClass
     */
    public function getItemWidgetCounters(): stdClass
    {
        return DB::table('items')
            ->selectRaw('count(case when deleted_at = null then 1 end) as total')
            ->selectRaw('sum(case when deleted_at = null then quantity end) as quantity_count')
            ->first();
    }

    /**
     * Method for getting all the counters for the dashboard that are related to the dashboard.
     *
     * @return stdClass
     */
    public function getCategoryWidgetCounter(): stdClass
    {
        return DB::table('categories')
            ->selectRaw('count(*) as total')
            ->selectRaw('count(case when created_at like curdate() then 1 end) as today_count')
            ->first();
    }

    /**
     * Get all the counters from the locations that are related to the dashboard
     *
     * @return array
     */
    public function getLocationsWidgetCounters(): array
    {
        return [
            'total' => Location::count(),
            'today_count' => Location::where('created_at', now()->today())->count()
        ];
    }
}
