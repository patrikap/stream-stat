<?php

namespace App\Http\Controllers\API\V1;

use App\DataProviders\TwitchStreamDataProvider;
use App\Http\Controllers\API\AbstractApiController;
use App\Services\StreamService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class StreamController extends AbstractApiController
{
    /**
     * работа со списком стримов
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        return $this->json($request->all());
    }

    /**
     * работа с количеством смотрящих
     * @param Request $request
     * @return JsonResponse
     */
    public function viewerCount(Request $request): JsonResponse
    {
        return $this->json($request->all());
    }

    /**
     * Аналог команды - для отладки из докера
     * @param StreamService $service
     * @param TwitchStreamDataProvider $dataProvider
     */
    public function collect(StreamService $service, TwitchStreamDataProvider $dataProvider): void
    {
        // не выносим
        $service->collect($dataProvider);
    }
}
