<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class isGuest
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
        //cek kalau di authnya udah ada history login, dia ga boleh masuk ke login lagi maka di redirect ke:
        if(Auth::check()){
            return redirect(route('dashboard'))->with('notAllowed','Anda sudah login!') ;
        }   
        //kalau gaada history login, baru boleh next ke login
        return $next($request);
    }
}
