<?php
declare(strict_types = 1);


namespace App\DTO;


/**
 * Class TwitchStream
 * @package App\DTO
 *
 * @project stream-stat
 * @date 09.10.2020 13:55
 * @author Konstantin.K
 */
class TwitchStream extends AbstractStream
{
    /** @inheritDoc */
    protected function getService(): string
    {
        return 'twitch';
    }
}
