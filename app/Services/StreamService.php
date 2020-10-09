<?php
declare(strict_types = 1);

namespace App\Services;

use App\DataProviders\StreamDataProviderInterface;
use App\Repositories\Interfaces\GamesRepositoryInterface;
use App\Repositories\Interfaces\StreamRepositoryInterface;
use DateTime;

/**
 * Class StreamService
 *
 * Сервис работы со стримами
 *
 * @project stream-stat
 * @date 07.10.2020 22:03
 * @author Konstantin.K
 */
class StreamService
{
    protected GamesRepositoryInterface $gamesRepository;
    protected StreamRepositoryInterface $streamRepository;

    public function __construct(GamesRepositoryInterface $gamesRepository, StreamRepositoryInterface $streamRepository)
    {
        $this->gamesRepository = $gamesRepository;
        $this->streamRepository = $streamRepository;
    }

    /**
     * @param StreamDataProviderInterface $streamDataProvider
     */
    public function collect(StreamDataProviderInterface $streamDataProvider): void
    {
        // получить список игр
        $games = $this->gamesRepository->getGamesToCollectStreams();
        // получить активные трансляции для этих игр
        $streams = $streamDataProvider->getStreamsForGames($games);
        // преобразовать
        $now = new DateTime();
        $batch = [];
        foreach ($streams as $stream) {
            $item = $stream->toArray();
            $item['created_at'] = $now;
            unset($item['stream_id']);
            $batch[] = $item;
        }
        // записать в БД
        $this->streamRepository->bulkInsert($batch);
    }
}
