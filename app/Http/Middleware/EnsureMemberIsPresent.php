<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class EnsureMemberIsPresent
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        if (!$user || !$user->isPresent()) {
            return redirect()->route('attendance.scan')
                ->with('error', 'You must confirm your attendance via QR scan to access this module.');
        }

        return $next($request);
    }
}
