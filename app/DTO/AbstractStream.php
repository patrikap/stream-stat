<?php
declare(strict_types = 1);


namespace App\DTO;


use Illuminate\Contracts\Support\Arrayable;

/**
 * Class Stream
 * @package App\DTO
 *
 * базовый предок стрим ДТО
 *
 * @project stream-stat
 * @date 09.10.2020 13:43
 * @author Konstantin.K
 */
abstract class AbstractStream implements Arrayable
{
    protected int $id;
    protected int $channelId;
    protected int $gameId;
    protected string $service;
    protected int $viewerCount = 0;

    public function __construct(int $id, int $channelId, int $gameId, int $viewerCount)
    {
        $this->id = $id;
        $this->channelId = $channelId;
        $this->gameId = $gameId;
        $this->service = $this->getService();
        $this->viewerCount = $viewerCount;
    }

    abstract protected function getService(): string;

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'stream_id'    => $this->id,
            'channel_id'   => $this->channelId,
            'game_id'      => $this->gameId,
            'service'      => $this->service,
            'viewer_count' => $this->viewerCount,
        ];
    }
}
