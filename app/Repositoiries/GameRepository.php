<?php
declare(strict_types = 1);


namespace App\Repositories;


use App\Models\Game;
use App\Repositories\Interfaces\GamesRepositoryInterface;

/**
 * Class GameRepository
 * @package App\Repositories
 *
 * Конкретный репозиторий для Игр
 *
 * @project stream-stat
 * @date 07.10.2020 22:59
 * @author Konstantin.K
 */
class GameRepository implements GamesRepositoryInterface
{
    /**
     * Возвращает список игра в качестве массива айдишников
     * @inheritDoc
     */
    public function getGamesToCollectStreams(): array
    {
        return Game::all()->pluck('id')->toArray();
    }
}
