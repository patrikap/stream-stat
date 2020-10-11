<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

/**
 * Class AbstractApiController
 * @package App\Http\Controllers\API
 *
 * базовый контроллер для API
 *
 * @project stream-stat
 * @date 11.10.2020 21:58
 * @author Konstantin.K
 */
class AbstractApiController extends Controller
{
    /**
     * Return json response
     *
     * @param $data
     * @param int $status
     * @param array $headers
     * @return JsonResponse
     */
    protected function json($data, int $status = JsonResponse::HTTP_OK, array $headers = []): JsonResponse
    {
        return response()->json($data, $status, $headers);
    }
}
