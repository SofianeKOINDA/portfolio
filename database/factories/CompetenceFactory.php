<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Competence>
 */
class CompetenceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $competences = [
            'Technique' => [
                'PHP', 'Laravel', 'JavaScript', 'Vue.js', 'MySQL', 'Git', 'Docker', 'API REST',
                'HTML/CSS', 'Bootstrap', 'Tailwind CSS', 'React', 'Node.js', 'MongoDB'
            ],
            'Soft skills' => [
                'Communication', 'Travail d\'équipe', 'Résolution de problèmes', 'Adaptabilité',
                'Gestion du temps', 'Leadership', 'Créativité', 'Apprentissage continu'
            ]
        ];

        $type = fake()->randomElement(['Technique', 'Soft skills']);
        $competence = fake()->randomElement($competences[$type]);

        return [
            'nom' => $competence,
            'niveau' => fake()->numberBetween(1, 5),
            'type' => $type,
            'description' => fake()->sentence(),
            'etat' => fake()->randomElement(['Actif', 'Inactif']),
        ];
    }
}
