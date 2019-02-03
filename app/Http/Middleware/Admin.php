<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Support\Facades\Auth;

class Admin
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

        if(Auth::check()){
            if(Auth::user()->isAdmin()){
                return $next($request);
            }
        }

        //if the logged user is not an admit, and the user want to see http://localhost:8000/admin/users, it 
        // returns to the home page
        return redirect("/");

       //  return $next($request);
    }
}
