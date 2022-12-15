<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class checkToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // dd($request->header('Authorization'));
        if ($request->header('Authorization') == "Bearer 2d0a15cbc652f53fb062372f73b6e120fe31ca4381aeafebb8289280e24f66e2") {
            return $next($request);
        }
        return response()->json('Unauthorized access'); 
    }
}
