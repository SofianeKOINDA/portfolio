<?php

namespace Database\Factories;

use App\Models\Entreprise;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Formation>
 */
class FormationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $diplomes = [
            'Licence en Informatique', 'Master en Génie Logiciel', 'BTS en Informatique',
            'Ingénieur en Informatique', 'Certification AWS', 'Certification Microsoft',
            'Formation Laravel', 'Formation Vue.js', 'Formation DevOps'
        ];

        return [
            'duree' => fake()->randomElement(['2022 - 2023', '2023 - 2024', '2024 - 2025', '2025 - à nos jours']),
            'diplome' => fake()->randomElement($diplomes),
            'etat' => fake()->randomElement(['Actif', 'Inactif']),
            'entreprise_id' => Entreprise::factory(),
        ];
    }
}
