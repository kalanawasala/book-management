<?php

namespace App\Http\Middleware;


use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Tymon\JWTAuth\Exceptions\JWTException;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            return redirect(RouteServiceProvider::HOME);
        }

        return $next($request);
    }

    try {
        $headers = apache_request_headers(); //get header
        $request->headers->set('Authorization', $headers['authorization']);// set header in request

        $user = JWTAuth::parseToken()->authenticate();
    } catch (Exception $e) {
        if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException){
            return response()->json(['status' => 'Token is Invalid']);
        }else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException){
            return response()->json(['status' => 'Token is Expired']);
        }else{
            return response()->json(['status' => 'Authorization Token not found']);
        }
    }
}
