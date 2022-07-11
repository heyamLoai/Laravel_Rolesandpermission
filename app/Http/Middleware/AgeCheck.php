<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AgeCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next , ...$age)
    { 
        //before middleware
        // $age = 16;
        if($age < 18){
            abort(403, 'Age doesnt meet requirement, Access denied ');
        }
        return $next($request);

        //after middleware
        // $response= $next($request);
        // $age = 16;
        // if($age< 18){
        //     abort(403, 'Age doesnt meet requirement, Access denied ');
        // }
        // return $response; 
    }


}
