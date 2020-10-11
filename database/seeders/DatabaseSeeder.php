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
        // создаём пользователя
        $user = \App\Models\User::factory()->create();
        /** @var User $user */
        // добавляем ему токен доступа с "полными правами"
        print '>>>' . $user->createToken('web', ['*'])->plainTextToken . '<<<' . PHP_EOL;
        // наполняем табличку с играми топом игр от твича
        $this->call(GameSeeder::class);
    }
}
