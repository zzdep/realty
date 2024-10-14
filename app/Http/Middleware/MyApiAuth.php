<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Api\v1\ApiController;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MyApiAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        return ApiController::checkToken($request) ? $next($request) : response(null, 401);
    }
}
