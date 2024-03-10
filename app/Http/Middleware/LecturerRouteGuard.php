<?php

namespace App\Http\Middleware;

use App\Enums\RoleEnum;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LecturerRouteGuard
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->user()->role == RoleEnum::Lecturer) {
            return redirect('/')->with('error_message', 'ไม่มีสิทธิ์ในการเข้าถึงหน้านี้');
        }
        return $next($request);
    }
}
