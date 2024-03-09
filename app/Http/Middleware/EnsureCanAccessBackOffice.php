<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureCanAccessBackOffice
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->user()->role !== 'MODERATOR' || auth()->user()->role !== 'LECTURER') {
            return redirect('/')->with('error_message', 'ไม่มีสิทธิ์ในการเข้าถึงหน้านี้');
        }
        return $next($request);
    }
}
