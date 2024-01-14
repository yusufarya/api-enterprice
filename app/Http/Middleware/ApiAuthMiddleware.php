<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ApiAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->header('Authorization');
        $authenticaate = true;
        
        if(!$token) {
            $authenticaate = false;
        }
        
        $user = User::where('token', $token)->first();
        // dd($user);
        if(!$user) {
            $authenticaate = false;
        }

        if($authenticaate) {
            Auth::login($user);
            return $next($request);
        } else {
            return response()->json([
                'errors' => 'unauthorized'
            ])->setStatusCode(401);
        }

    }
}
