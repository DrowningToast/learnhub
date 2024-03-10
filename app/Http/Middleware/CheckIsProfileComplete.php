<?php

namespace App\Http\Middleware;

use Closure;
use App\Enums\RoleEnum;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckIsProfileComplete
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();

        $isProfileComplete = $user->first_name == null || $user->last_name == null || $user->phone == null || $user->email == null;
        $isModerator = $user->role->value == RoleEnum::Moderator->value;

        if ($isProfileComplete && !$isModerator) {
            return redirect('/profile')->with('error_message', 'โปรดกรอกข้อมูลส่วนตัวให้ครบถ้วนก่อนเริ่มใช้งาน LearnHub');
        }

        return $next($request);
    }
}
