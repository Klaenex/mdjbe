<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(userSeeder::class);
        $this->call(dispositifParticulierSeeder::class);
        $this->call(mdjSeeder::class);
        $this->call(projetPorteurSeeder::class);
    }
}
