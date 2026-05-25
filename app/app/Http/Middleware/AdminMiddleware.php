<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // 未ログイン or is_admin が false なら 403
        if (! $request->user()?->is_admin) {
            abort(403);
        }
        return $next($request);
    }
}