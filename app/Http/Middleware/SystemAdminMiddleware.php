<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SystemAdminMiddleware
{
    /**
     * Handle System Admins Middleware And It's Conditions.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();
        if ($user['userWeight'] >= 99.99 && strtoupper($user['isActive']) == 1 && in_array('system',explode(',', $user['userDomains'])))
        {
            return $next($request);
        }
        return response()->json(['status' => 404, 'message' => 'Sorry, you are not permitted to enter here. Please contact to your System Admin.'], 404);
    }
}
