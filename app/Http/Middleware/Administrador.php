<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;
use App\User;

class Administrador
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if ( Auth::check())
        {
        $user = User::where('id', '=', Auth::user()->id)->first();
            if($user->rol_id == 2){
                return $next($request);    
            }
            
        }

        return redirect('home');
    }
    /*public function handle($request, Closure $next, $guard = null)
    {
        if ( Auth::check())
        {
        $user = Rol_User::where('user_id', 'like', '%'.Auth::user()->id.'%')->first();
            if($user->rol_id == 2){
                return $next($request);    
            }
            
        }

        return redirect('home');
    }*/
}
