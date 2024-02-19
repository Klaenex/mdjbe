<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class userSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'John',
            'email' => 'vincent.cuozzo@fcjmp.be',
            'password' => Hash::make('0000'),
            'is_admin' => true,

        ]);
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'Admin@doe.be',
            'password' => Hash::make('0000'),
            'is_admin' => false,
        ]);
        // for ($i = 1; $i <= 50; $i++) {
        //     DB::table('users')->insert([
        //         'name' => 'User ' . $i,
        //         'email' => 'user' . $i . '@example.com',
        //         'password' => Hash::make('password'),
        //         'is_admin' => false,
        //     ]);
        // }
    }
}
