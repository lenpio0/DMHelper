<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ShareSessionData
{
    public function handle(Request $request, Closure $next)
    {
        Inertia::share([
            'flash' => function () use ($request) {
                return [
                    'message' => session('flash.banner'),
                    'style' => session('flash.bannerStyle'),
                    'tab' => session('flash.tab'),
                ];
            },
        ]);

        return $next($request);
    }
}