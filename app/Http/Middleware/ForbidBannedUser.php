<?php

namespace App\Http\Middleware;

use Closure;
use Cog\Contracts\Ban\Bannable as BannableContract;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;

/**
 * Class ForbidBannedUser
 *
 * @package App\Http\Middleware
 */
class ForbidBannedUser
{
    /**
     * The guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * ForbidBannedUser constructor.
     *
     * @param  Guard $auth
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param  Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = $this->auth->user();

        if ($user && $user instanceof BannableContract && $user->isBanned()) {
            return redirect()->route('user.blocked');
        }

        return $next($request);
    }
}
