<?php
declare(strict_types = 1);


namespace App\Repositories;


use App\Repositories\Interfaces\StreamRepositoryInterface;
use Illuminate\Support\Facades\DB;

/**
 * Class StreamRepository
 * @package App\Repositories
 *
 * репозиторий для работы с стримами
 *
 * @project stream-stat
 * @date 09.10.2020 15:26
 * @author Konstantin.K
 */
class StreamRepository implements StreamRepositoryInterface
{
    /** @inheritDoc */
    public function bulkInsert(array $batch): void
    {
        DB::table('streams')->insert($batch);
    }
}
