<?php
declare(strict_types = 1);


namespace App\Console\Commands;


use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

/**
 * Class DBCreateCommand
 * @package App\Console\Commands
 *
 * команда для создания БД
 *
 * @project stream-stat
 * @date 11.10.2020 21:58
 * @author Konstantin.K
 */
class DBCreateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create database';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        // читаем настройки в переменные
        $connectionName = config('database.default');
        $databaseName = config("database.connections.{$connectionName}.database");
        // временно очищаем конфиг, чтобы не было первичного ЮЗ
        config(["database.connections.{$connectionName}.database" => null]);
        // создаём БД
        DB::statement("CREATE DATABASE IF NOT EXISTS " . $databaseName. " DEFAULT CHARACTER SET utf8;");
        // возвращаем всё как было
        config(["database.connections.{$connectionName}.database" => $databaseName ]);
    }
}
