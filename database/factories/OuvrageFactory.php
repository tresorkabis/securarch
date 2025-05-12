<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ouvrage>
 */
class OuvrageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'titre' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
            'auteur_id' => $this->faker->numberBetween(1, 20),
            'domaine_id' => $this->faker->numberBetween(1, 14),
            'isbn' => $this->faker->unique()->isbn13(),
            'editeur' => $this->faker->company(),
            'date_publication' => $this->faker->date(),
            'nombre_pages' => $this->faker->numberBetween(50, 500),
            'langue' => $this->faker->languageCode(),
            'format_fichier' => $this->faker->randomElement(['PDF', 'DOCX', 'EPUB']),
            'taille_fichier' => $this->faker->randomFloat(2, 0.5, 10) . ' MB',
            'chemin_fichier' => $this->faker->filePath(),
        ];
    }
}
