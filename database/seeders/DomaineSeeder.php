<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DomaineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $domaines = [
            'Ressources Humaines',
            'Finance',
            'Comptabilité',
            'Marketing',
            'Commercial',
            'Production',
            'Recherche et Développement',
            'Informatique',
            'Juridique',
            'Direction Générale',
            'Communication',
            'Qualité',
            'Logistique',
            'Achats',
        ];

        foreach ($domaines as $domaine) {
            \App\Models\Domaine::updateOrCreate(
                ['nom' => $domaine],
                ['description' => fake()->sentence()]
            );
        }
    }
}
