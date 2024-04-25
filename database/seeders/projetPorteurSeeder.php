<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class projetPorteurSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('projet_porteur')->insert([
            'name' => 'test projets porteur1',
            'mdj_id' => '1',
        ]);
        DB::table('projet_porteur')->insert([
            'name' => 'test projets porteur2',
            'mdj_id' => '1',
        ]);
    }
}
