<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = \App\Models\User::factory()->create();
        /** @var User $user */
        print '>>>' . $user->createToken('web', ['*'])->plainTextToken . '<<<' . PHP_EOL;
        $this->call(GameSeeder::class);
    }
}
