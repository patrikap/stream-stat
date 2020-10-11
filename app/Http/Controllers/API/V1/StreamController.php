<?php

namespace App\Http\Controllers\API\V1;

use App\DataProviders\TwitchStreamDataProvider;
use App\Http\Controllers\API\AbstractApiController;
use App\Http\Filters\StreamQueryFilter;
use App\Models\Stream;
use App\Http\Resources\StreamResource;
use App\Services\StreamService;
use Illuminate\Http\JsonResponse;

class StreamController extends AbstractApiController
{
    /**
     * работа со списком стримов
     * @param StreamQueryFilter $filter
     * @return JsonResponse
     */
    public function index(StreamQueryFilter $filter): JsonResponse
    {
        $streams = Stream::filter($filter)->get();

        return $this->json(StreamResource::collection($streams));
    }

    /**
     * работа с количеством смотрящих
     * @param StreamQueryFilter $filter
     * @return JsonResponse
     */
    public function viewerCount(StreamQueryFilter $filter): JsonResponse
    {
        $viewerCount = Stream::filter($filter)->sum('viewer_count');

        return $this->json($viewerCount);
    }

    /**
     * Аналог команды - для отладки из докера
     * @param StreamService $service
     * @param TwitchStreamDataProvider $dataProvider
     */
    public function collect(StreamService $service, TwitchStreamDataProvider $dataProvider): void
    {
        $service->collect($dataProvider);
    }
}
