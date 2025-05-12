<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Auteur;
use App\Models\Domaine;
use App\Models\Ouvrage;
use App\Models\Rapport;
use App\Models\TypeRapport;
use App\Services\AgentImportService;
use Doctrine\DBAL\Types\Type;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(4)->create();

        \App\Models\User::factory()->create([
            'name' => 'Administrateur',
            'email' => 'admin@securarch.test',
        ]);

        $importSerice = app(AgentImportService::class);
        $result = $importSerice->importAgents();

        $this->call(TypeRapportSeeder::class);
        $this->call(DomaineSeeder::class);
        Auteur::factory(20)->create();
        Ouvrage::factory(50)->create();
        Rapport::factory(100)->create();
    }
}
