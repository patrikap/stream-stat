<?php

namespace App\Providers;

use App\Repositories\Interfaces\GamesRepositoryInterface;
use App\Repositories\Interfaces\StreamRepositoryInterface;
use App\Repositories\GameRepository;
use App\Repositories\StreamRepository;
use App\Services\StreamService;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        // сервис сборщика, всегда в единичном экземпляре, дабы не плодить объекты без нужды
        $this->app->singleton(StreamService::class, StreamService::class);
        $this->app->singleton(StreamRepositoryInterface::class, StreamRepository::class);
        $this->app->singleton(GamesRepositoryInterface::class, GameRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        //
    }

    /** @inheritDoc */
    public function provides(): array
    {
        return [
            StreamService::class,
            GamesRepositoryInterface::class,
            StreamRepositoryInterface::class,
        ];
    }
}
