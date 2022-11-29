<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckLoginMiddleware
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
        if(Auth::guest()){
            return redirect()->route('admin.login')->with('error','Bạn chưa đăng nhập !!!');
        }
        if(Auth::user()->level==0){
            return redirect()->route('driver.index')->with('success','Chúc mừng bạn đăng nhập thành công');
        }
        return $next($request);
    }
}
