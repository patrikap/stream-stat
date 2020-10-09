<?php
declare(strict_types = 1);

namespace App\DataProviders;

use App\DTO\AbstractStream;

/**
 * Class StreamDataProviderInterface
 *
 * Интерфейс поставщиков данных о стримах
 *
 * @project stream-stat
 * @date 07.10.2020 22:38
 * @author Konstantin.K
 */
interface StreamDataProviderInterface
{
    /**
     * Возвращает список стримов по играм
     * @param array $gameIds
     * @return AbstractStream[]
     */
    public function getStreamsForGames(array $gameIds): array;
}
