<?php
declare(strict_types = 1);

namespace App\DTO;
/**
 * Class TwitchToken
 *
 * объект токена твича
 *
 * @project stream-stat
 * @date 09.10.2020 12:14
 * @author Konstantin.K
 */
class TwitchToken
{
    /** @var string токен */
    protected string $token;
    /** @var int через сколько истекает */
    protected int $expiresIn;
    /** @var string тип */
    protected string $type;

    public function __construct(string $token, int $expiresIn, $type)
    {
        $this->token = $token;
        $this->expiresIn = $expiresIn;
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * @return int
     */
    public function getExpiresIn(): int
    {
        return $this->expiresIn;
    }
}
