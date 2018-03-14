<?php

namespace App\Http\Middleware;

use Closure;
use App\User;

class UserAdminAuthMiddleware
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
        $is_correct = false;
        if(session()->has('user_email')){
            $user_result = User::where(['email'=>session('user_email')])->firstOrFail();
            $is_correct = $user_result->type == 'A';
        }
        if(!$is_correct)
            return redirect('/');
        else
            return $next($request);
    }
}
