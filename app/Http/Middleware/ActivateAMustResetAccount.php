<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ActivateAMustResetAccount
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
        if($request->user()->must_reset == 1){
            return redirect('/users/registration');
        }
        return $next($request);
    }
}
