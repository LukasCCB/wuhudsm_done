<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\DB;

class cors
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
        $allowedOrigins = DB::table('allowed_ips')->select('ip')->get();
        $allowedOrigins = $allowedOrigins->pluck('ip')->toArray();

        // Check if have any row with value '*'
        $allAccess = false;
        if (in_array('*', $allowedOrigins)) {
            $allAccess = true;
        }

        if ($allAccess || in_array($request->getClientIp(), $allowedOrigins)) {
            return $next($request)
                ->header('Access-Control-Allow-Origin', '*')
                ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
                ->header('Access-Control-Allow-Headers', 'Content-Type, Authorization');
        }

        /*if (in_array($request->getClientIp(), $allowedOrigins)) {
            return $next($request)
                ->header('Access-Control-Allow-Origin', $request->getClientIp())
                ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
                ->header('Access-Control-Allow-Headers', 'Content-Type, Authorization');
        }*/

        \Log::debug('Blocked IP: ' . $request->getClientIp()); // Log
        return response('You are not authorized to access this resource.', 401);
    }
}
