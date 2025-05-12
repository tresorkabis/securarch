<?php

namespace Database\Factories;

use App\Models\Agent;
use App\Models\TypeRapport;
use App\Services\CountryService;
use Doctrine\DBAL\Types\Type;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Rapport>
 */
class RapportFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $countryService = app(CountryService::class);
        $countries = $countryService->getCountries();
        return [
            'type_rapport_id' => $this->faker->numberBetween(1, TypeRapport::count()),
            'intitule' => $this->faker->sentence(),
            'fichier' => $this->faker->filePath(),
            'debut_periode' => $this->faker->date(),
            'fin_periode' => $this->faker->date(),
            'agent_id' => $this->faker->numberBetween(1, Agent::count()),
            'pays' => $this->faker->randomElement(array_keys($countries)),
        ];
    }
}
