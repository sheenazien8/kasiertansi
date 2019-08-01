<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Owner;
use App\Models\Employee;
use Illuminate\Support\Facades\Cache;

class CheckEmployee
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (auth()->user()->userable instanceof Owner) {
            Cache::forever('owner-cache', auth()->user());
        }elseif (auth()->user()->userable instanceof Employee) {
            Cache::forever('owner-cache', auth()->user()->userable->owner->user);
        }
        return $next($request);
    }
}
