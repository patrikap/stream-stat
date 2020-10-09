<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\DataProviders\TwitchStreamDataProvider;

class GameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(TwitchStreamDataProvider $provider)
    {
        // засеиваем топом игр из твича
        $games = $provider->getTopGames();
        DB::table('games')->insert($games);
    }
}
