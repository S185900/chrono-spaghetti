<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        // 呼び出すシーダーをここに並べる
        $this->call([
            UserSeeder::class,
            CategorySeeder::class,
        ]);
    }
}
