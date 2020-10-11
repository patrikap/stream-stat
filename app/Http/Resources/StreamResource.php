<?php
declare(strict_types = 1);


namespace App\Http\Resources;


use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class Stream
 * @package App\Http\Resources
 *
 * Ресурс для работы со стримами
 *
 * @project stream-stat
 * @date 12.10.2020 0:30
 * @author Konstantin.K
 */
class StreamResource extends JsonResource
{
    /** @inheritDoc */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'channelId' => $this->channel_id,
            'gameId' => $this->game_id,
            'service' => $this->service,
            'viewerCount' => $this->viewer_count,
            'createdAt' => $this->created_at,
        ];
    }
}
