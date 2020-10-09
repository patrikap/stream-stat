<?php
declare(strict_types = 1);

namespace App\Repositories\Interfaces;
/**
 * Class GamesRepositoryInterface
 *
 * Интерфейс для работы с данными об играх
 *
 * @project stream-stat
 * @date 07.10.2020 22:26
 * @author Konstantin.K
 */
interface GamesRepositoryInterface
{
    /**
     * Возвращает массив игр для сбора стримов по ним
     * @return array
     */
    public function getGamesToCollectStreams(): array;
}
