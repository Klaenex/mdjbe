<?php

namespace Database\Seeders;

use App\Models\Mdjs;
use Illuminate\Database\Seeder;

class mdjSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Mdjs::factory()->count(20)->create();
    }
}
