<?php

namespace Database\Factories;

use App\Models\Entreprise;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Experience>
 */
class ExperienceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $postes = [
            'Développeur Full Stack', 'Développeur Backend', 'Développeur Frontend',
            'Chef de projet', 'Analyste programmeur', 'Développeur Mobile',
            'DevOps Engineer', 'Data Analyst', 'UI/UX Designer'
        ];

        return [
            'poste' => fake()->randomElement($postes),
            'duree' => fake()->randomElement(['6 mois', '1 an', '2 ans', '3 ans', '4 ans']),
            'tache' => fake()->paragraph(),
            'etat' => fake()->randomElement(['Actif', 'Inactif']),
            'entreprise_id' => Entreprise::factory(),
        ];
    }
}
