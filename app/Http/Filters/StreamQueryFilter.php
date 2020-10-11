<?php
declare(strict_types = 1);


namespace App\Http\Filters;


use DateTime;
use Exception;

/**
 * Class StreamFilter
 * @package App\Http\Filters
 *
 * конкретный фильтр для стримов
 *
 * @project stream-stat
 * @date 12.10.2020 0:51
 * @author Konstantin.K
 */
class StreamQueryFilter extends QueryFilter
{
    /** @var int секунды от текущей метки времени означающие "текущий момент" */
    protected const NOW_DIFF_TIME = 300;
    /** @var string формат даты по умолчанию */
    protected const TIME_FORMAT = 'Y-m-d H:i:s';

    /**
     * фильтруем конкретную игру
     * @param int $gameId
     */
    public function game(int $gameId): void
    {
        $this->builder->where('game_id', $gameId);
    }

    /**
     * фильтруем список игр через запятую
     * @param string $games
     */
    public function games(string $games): void
    {
        $gameIds = array_filter(explode(',', $games));
        $this->builder->whereIn('game_id', $gameIds);
    }

    /**
     * дата с
     * @param string $fromDate
     * @throws Exception
     */
    public function from(string $fromDate): void
    {
        $this->builder->where('created_at', '>=', new DateTime($fromDate));
    }

    /**
     * дата по
     * @param string $toDate
     * @throws Exception
     */
    public function to(string $toDate): void
    {
        $this->builder->where('created_at', '<=', new DateTime($toDate));
    }

    /**
     * текущее время +- 5 минут
     * @param bool $now
     * @throws Exception
     */
    public function now(bool $now): void
    {
        if ($now === true) {
            $time = new DateTime();
            $time->modify("-" . static::NOW_DIFF_TIME . " second");
            $this->from($time->format(static::TIME_FORMAT));
            $time->modify("+" . (static::NOW_DIFF_TIME * 2) . " second");
            $this->to($time->format(static::TIME_FORMAT));
        }
    }
}
