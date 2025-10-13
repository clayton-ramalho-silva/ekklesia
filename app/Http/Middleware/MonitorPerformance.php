<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class MonitorPerformance
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!env('MONITORING_ENABLED', false)) {
            return $next($request);
        }

        // Se desejar somente para usuários autenticados/admins
        if (env('MONITORING_ADMIN_ONLY', true)) {
            $user = $request->user();
            if (!$user) {
                return $next($request);
            }
            // Se você tem is_admin no model, ele pode ser checado aqui; caso contrário, qualquer usuário autenticado "passa"
            if (property_exists($user, 'is_admin') && !$user->is_admin) {
                return $next($request);
            }
        }

        // Start
        $start = microtime(true);
        DB::flushQueryLog();
        DB::enableQueryLog();

        $response = $next($request);

        $durationMs = (microtime(true) - $start) * 1000;
        $queries = DB::getQueryLog();
        $queriesCount = count($queries);
        $queriesTime = 0.0;
        foreach ($queries as $q) {
            $queriesTime += $q['time'] ?? 0;
        }

        $payload = [
            'timestamp' => now()->toDateTimeString(),
            'method' => $request->method(),
            'path' => $request->path(),
            'route' => optional($request->route())->getName(),
            'status' => $response->getStatusCode(),
            'duration_ms' => round($durationMs, 2),
            'queries_count' => $queriesCount,
            'queries_time_ms' => round($queriesTime, 2),
            'user_id' => optional($request->user())->id,
            'ip' => $request->ip(),
            'memory_bytes' => memory_get_usage(),
            'memory_peak_bytes' => memory_get_peak_usage(),
        ];

        // Log estruturado no canal performance
        Log::channel('performance')->info('request', $payload);

        return $response;
    }
}
