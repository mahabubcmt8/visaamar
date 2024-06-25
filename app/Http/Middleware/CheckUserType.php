<?php
// app/Http/Middleware/CheckUserType.php

namespace App\Http\Middleware;

use Closure;

class CheckUserType
{
    public function handle($request, Closure $next, $type)
    {
        // Check if the authenticated user's type matches the specified type
        if (auth()->check() && auth()->user()->type == $type) {
            return $next($request);
        }

        return redirect()->route('logout2')->with('warning', 'User Not Found!');
        // abort(403, 'Unauthorized.');
    }
}
