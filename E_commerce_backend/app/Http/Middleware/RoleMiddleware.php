<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next , ...$roles): Response
    {
        $user = Auth::user();

        if(!$user||!$user->role||!in_array($user->role->name,$roles) ){
            return response()->json(["messagge"=>"you don't belong here"],403);
        }
        
        return $next($request);
    }
}
