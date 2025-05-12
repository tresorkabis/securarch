<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeRapportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            ['id' => 1, 'nom' => 'Formation'],
            ['id' => 2, 'nom' => 'Stage'],
            ['id' => 3, 'nom' => 'Mission'],
        ];

        foreach ($types as $type) {
            \App\Models\TypeRapport::updateOrCreate(
                ['id' => $type['id']],
                ['nom' => $type['nom']]
            );
        }
    }
}
