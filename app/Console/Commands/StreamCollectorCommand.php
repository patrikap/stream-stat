<?php

namespace App\Console\Commands;

use App\DataProviders\TwitchStreamDataProvider;
use App\Services\StreamService;
use Illuminate\Console\Command;

/**
 * Class StreamCollectorCommand
 * @package App\Console\Commands
 *
 * Команда запускает сервис сбора стримов
 *
 * @project stream-stat
 * @date 07.10.2020 22:06
 * @author Konstantin.K
 */
class StreamCollectorCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'stream:collect';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Collect streams';

    /**
     * Execute the console command.
     * @param StreamService $service
     * @param TwitchStreamDataProvider $dataProvider
     */
    public function handle(StreamService $service, TwitchStreamDataProvider $dataProvider): void
    {
        // не выносим
        $service->collect($dataProvider);
    }
}
