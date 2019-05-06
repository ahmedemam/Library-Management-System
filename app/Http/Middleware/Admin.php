<?php

namespace App\Http\Middleware;

use Closure;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (auth()->user()->isAdmin == 'yes') {
            return $next($request);
        }
<<<<<<< HEAD
        return redirect(‘home’)->with("error", "You have not admin access");
    }}

=======
        return redirect('unauthorized');
    }
}
>>>>>>> 591e50e640803ed792f57ae70ca5d790fa1b7d09
