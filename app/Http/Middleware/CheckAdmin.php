<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if the user has the 'admin' role
        if (auth()->user() && auth()->user()->role != 'admin') {
            // If the user is not an admin, redirect them to the regular dashboard
            return redirect()->route('dashboard');
        }

        return $next($request); // Proceed if the user is an admin
    }
}
