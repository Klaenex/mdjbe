<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class dispositifParticulierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('dispositif_particulier')->insert([
            [
                'name' => "Politique socioculturelle d'égalité des chances",
                'desc' => "Ce dispositif est destiné aux maisons de jeunes qui établissent et exécutent une programmation d'actions spécifiques pour les jeunes dont les conditions sociales, économiques ou culturelles sont les moins favorables.",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Décentralisation',
                'desc' => "Ce dispositif est accessible aux maisons de jeunes ou aux centres de rencontres et d'hébergement qui mettent en place des actions ou services pour des jeunes ou groupes de jeunes dont l'accès aux activités est limité par des contraintes géographiques ou des éléments culturels ou sociologiques liés au milieu d'implantation.",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => "Aide permanente à l'expression et à la création des jeunes",
                'desc' => "Ce dispositif est destiné aux maisons de jeunes ou aux centres de rencontres et d'hébergement qui développent des programmes d'actions pour soutenir et développer les capacités d'expression et de création des jeunes, en utilisant différents modes de communication ou d'expression.",
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
