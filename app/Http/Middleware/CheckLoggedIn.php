<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CheckLoggedIn
{
    public function handle(Request $request, Closure $next)
    {
        if (!Session::has('loggedIn')) {
            return redirect()->route('login.form')->withErrors(['error' => 'You need to be logged in.']);
        }

        return $next($request);
    }
}
