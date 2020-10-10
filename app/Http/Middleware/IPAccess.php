<?php
declare(strict_types = 1);


namespace App\Http\Middleware;


use App\Services\AccessService;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * Class IPAccess
 * @package App\Http\Middleware
 *
 * Посредник для фильтрации по айпи
 *
 * @project stream-stat
 * @date 10.10.2020 23:36
 * @author Konstantin.K
 */
class IPAccess
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!AccessService::checkAccess($request)) {
            return response()->json('IP mismatch', Response::HTTP_FORBIDDEN);
        }

        return $next($request);
    }
}
