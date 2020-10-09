<?php
declare(strict_types = 1);


namespace App\DataProviders;


use App\DTO\TwitchStream;
use App\DTO\TwitchToken;
use App\Exceptions\TwitchApiException;
use GuzzleHttp\Client;
use GuzzleHttp\Promise\Utils;
use GuzzleHttp\Psr7\Response;
use Illuminate\Support\Facades\Http;
use JsonException;
use Log;
use Psr\SimpleCache\CacheInterface;
use Psr\SimpleCache\InvalidArgumentException;

/**
 * Class TwitchStreamDataProvider
 * @package App\DataProviders
 *
 * Конкретный поставщик данных о стримах - твич
 *
 * @project stream-stat
 * @date 07.10.2020 22:39
 * @author Konstantin.K
 */
class TwitchStreamDataProvider implements StreamDataProviderInterface
{
    /** @var string базовый урл для запросов к Twitch */
    protected const BASE_URL = 'https://api.twitch.tv'; //helix/streams
    /** @var string url для авторизации */
    protected const AUTH_URL = 'https://id.twitch.tv/oauth2/token';
    /** @var string ключ для хранения токена */
    protected const CACHE_KEY = 'twitch_bearer_token';

    /** @var array массив реквестов */
    protected array $promises = [];

    /** @var Client|null клиент для запросов */
    protected ?Client $client = null;

    /** @var array массив ответов для асинхронной работы */
    protected array $responses = [];

    protected TwitchToken $token;

    protected CacheInterface $cacheProvider;

    public function __construct(CacheInterface $cache)
    {
        $this->cacheProvider = $cache;
    }

    /**
     * аутентификация на твиче, токен кладём в кеш пока не истечёт
     *
     * @return TwitchToken
     * @throws TwitchApiException
     * @throws InvalidArgumentException
     */
    protected function authenticate(): TwitchToken
    {
        if ($this->cacheProvider->has(self::CACHE_KEY)) {
            $this->token = $this->cacheProvider->get(self::CACHE_KEY);
        } else {
            $response = Http::post(self::AUTH_URL, [
                'client_id'     => config('streamStat.providers.twitch.clientId'),
                'client_secret' => config('streamStat.providers.twitch.secret'),
                'grant_type'    => 'client_credentials',
                'scope'         => '',
            ]);
            if (!$response->successful()) {
                throw new TwitchApiException('Token request is failed =[');
            }
            ['access_token' => $token, 'expires_in' => $expiresIn, 'token_type' => $type] = $response->json();
            $this->token = new TwitchToken($token, $expiresIn, $type);
            $this->cacheProvider->set(self::CACHE_KEY, $this->token, $this->token->getExpiresIn());
        }

        return $this->token;
    }

    /**
     * возвращает клиента для запросов к АПИ
     * @return Client
     * @throws InvalidArgumentException
     * @throws TwitchApiException
     */
    protected function getClient(): Client
    {
        $this->authenticate();
        if (!$this->client) {
            $this->client = new Client([
                'base_uri' => self::BASE_URL,
                'headers'  => [
                    'client-id'     => config('streamStat.providers.twitch.clientId'),
                    'Authorization' => 'Bearer ' . $this->token->getToken(),
                ],
            ]);
        }

        return $this->client;
    }

    /** @inheritdoc */
    public function getStreamsForGames(array $gameIds): array
    {
        $streams = [];
        foreach ($gameIds as $id) {
            $this->promises[] = $this->getClient()->getAsync('/helix/streams', [
                'game_id' => $id,
            ]);
        }
        $responses = Utils::settle($this->promises)->wait();
        foreach ($responses as $item) {
            if (!isset($item['value'])) {
                Log::warning('Invalid response structure', $item);
                continue;
            }
            $response = $item['value'];
            $body = $response->getBody();
            if (!$body) {
                continue;
            }
            /** @var Response $response */
            $json = $body->getContents();
            try {
                $data = json_decode($json, true, 512, JSON_THROW_ON_ERROR);
            } catch (JsonException $e) {
                Log::warning('Invalid json response', ['json' => $json]);
                continue;
            }
            if (!isset($data['data'])) {
                Log::warning('Invalid json structure', $item);
                continue;
            }
            foreach ($data['data'] as $stream) {
                ['id' => $id, 'user_id' => $userId, 'game_id' => $gameId, 'viewer_count' => $count] = $stream;
                $streams[] = new TwitchStream((int)$id, (int)$userId, (int)$gameId, (int)$count);
            }
        }

        return $streams;
    }

    /**
     * Возвращает топ игр ждя предзаполнения таблицы с играми
     * @return array
     * @throws InvalidArgumentException
     * @throws TwitchApiException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getTopGames(): array
    {
        $games = [];
        $response = $this->getClient()->get('/helix/games/top');
        $json = $response->getBody()->getContents();
        $data = json_decode($json, true, 512, JSON_THROW_ON_ERROR);
        foreach ($data['data'] as $game) {
            $games[] = [
                'id'   => (int)$game['id'],
                'name' => $game['name'],
            ];
        }

        return $games;
    }
}
