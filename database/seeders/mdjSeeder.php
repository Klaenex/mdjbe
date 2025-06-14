<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class mdjSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('mdjs')->insert([
            'name' => 'Maison des Jeunes Exemple',
            'location' => 'Un quartier agréable',
            'objective' => 'Offrir un espace de développement aux jeunes',
            'tagline' => 'Un lieu pour tous',
            'street' => 'Rue de la Paix',
            'dispositif_particulier' => null,
            'number' => '10',
            'postal_code' => '1000',
            'city' => 'Bruxelles',
            'email' => 'mdj@example.com',
            'site' => 'https://mdj-exemple.be',
            'facebook' => 'https://facebook.com/mdjexemple',
            'instagram' => 'https://instagram.com/mdjexemple',
            'tel' => '0488123456',
            'slug' => 'mdj-exemple',
            'region' => 'Bruxelles-Capitale',
            'active' => true,
            'id_user' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
