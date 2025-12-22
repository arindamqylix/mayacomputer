<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Auth;
use Closure;

class CenterMiddleware extends Middleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string[]  ...$guards
     * @return mixed
     */
    public function handle($request, Closure $next, ...$guards)
    {
        // First run the parent authentication check
        $this->authenticate($request, $guards);

        // Check if center is authenticated and status is active
        if (Auth::guard('center')->check()) {
            $center = Auth::guard('center')->user();
            
            // Check if center status is PENDING or BLOCKED
            if ($center->cl_account_status == 'PENDING') {
                Auth::guard('center')->logout();
                return redirect()->route('center_login')->with('error', 'Your Account is Not Approved Yet! Please Wait for Admin Approval.');
            }
            
            if ($center->cl_account_status == 'BLOCKED') {
                Auth::guard('center')->logout();
                return redirect()->route('center_login')->with('error', 'Your Account is Blocked! Please Contact Admin.');
            }
            
            // Only allow ACTIVE or APPROVED centers
            if ($center->cl_account_status != 'ACTIVE' && $center->cl_account_status != 'APPROVED') {
                Auth::guard('center')->logout();
                return redirect()->route('center_login')->with('error', 'Your Account is Not Active! Please Contact Admin.');
            }
        }

        return $next($request);
    }

    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return route('center_login');
        }
    }
}
