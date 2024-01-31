<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckLoginSession
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
        if ($request->session()->has('username')) {
            if ($request->session()->get('role') == 'admin') {
                return redirect('admin/dashboard');
            } else if ($request->session()->get('role') == 'user') {
                return redirect('user/pagination');
            }
        } else {
            return $next($request);
        }
    }
}
