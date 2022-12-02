<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class isLogin
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
        //ngecek kalo udh bener lanjut ke laman berikutnya
        if(Auth::check()){
            return $next($request);
        }   
        //kalau ga ada history login bakal diarahin lagi ke login dengan pesan
        return redirect('/')->with('notAllowed', 'Silahkan login terlebih dahulu');
    }
}
