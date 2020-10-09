<?php
declare(strict_types = 1);

namespace App\Repositories\Interfaces;
/**
 * Class StreamRepositoryInterface
 * @package App\Repositories\Interfaces
 *
 * Интерфейс репозитория для работы со стримами
 *
 * @project stream-stat
 * @date 09.10.2020 15:25
 * @author Konstantin.K
 */
interface StreamRepositoryInterface
{
    /**
     * вставляет пачкой стримы в БД
     * @param array $batch
     */
    public function bulkInsert(array $batch): void;
}
