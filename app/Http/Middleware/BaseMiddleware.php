<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

use Auth;
class BaseMiddleware
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
        // dd(Auth::guard('center'));
        // define('CENTER_ID', auth::guard('center')->user()->cl_id);
        // define('STUDENT_ID', auth::guard('student')->user()->sl_id);
        // define('ADMIN_ID', auth::guard('admin')->user()->al_id);
        // define('CUR', '₹');

        return $next($request);
    }
}
