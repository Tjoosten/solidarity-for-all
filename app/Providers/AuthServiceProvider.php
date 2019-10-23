<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Item;
use App\Models\Location;
use App\Models\User;
use App\Policies\CategoryPolicy;
use App\Policies\ItemPolicy;
use App\Policies\LocationPolicy;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

/**
 * Class AuthServiceProvider
 *
 * @package App\Providers
 */
class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Category::class => CategoryPolicy::class,
        User::class     => UserPolicy::class,
        Location::class => LocationPolicy::class,
        Item::class     => ItemPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->registerPolicies();
    }
}
