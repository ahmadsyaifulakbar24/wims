<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SuperAdminMiddleware
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
    	$role = session()->get('role');
    	if ($role == 1) {
	        return $next($request);
    	} else if ($role == 100) {
	        return redirect('dashboard');
    	} else {
	        return redirect('home');
    	}
    }
}
