<?php

namespace Database\Factories;

use App\Models\Competence;
use App\Models\Projet;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CompetenceProjet>
 */
class CompetenceProjetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'competence_id' => Competence::factory(),
            'projet_id' => Projet::factory(),
        ];
    }
}
