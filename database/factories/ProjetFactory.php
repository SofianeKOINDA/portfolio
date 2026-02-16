<?php

namespace Database\Factories;

use App\Models\Categorie;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Projet>
 */
class ProjetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $technologies = [
            ['PHP', 'Laravel', 'MySQL', 'Bootstrap'],
            ['JavaScript', 'Vue.js', 'Node.js', 'MongoDB'],
            ['React', 'TypeScript', 'Firebase'],
            ['Flutter', 'Dart', 'Firebase'],
            ['Python', 'Django', 'PostgreSQL'],
            ['Laravel', 'Vue.js', 'MySQL', 'Docker']
        ];

        return [
            'nom' => fake()->sentence(3),
            'photo1' => 'project1.jpg',
            'photo2' => 'project2.jpg',
            'photo3' => 'project3.jpg',
            'description' => fake()->paragraph(),
            'date' => fake()->dateTimeBetween('-2 years', 'now'),
            'client' => fake()->company(),
            'type' => fake()->randomElement(['Projet', 'Service']),
            'url' => fake()->url(),
            'technologies' => fake()->randomElement($technologies),
            'etat' => fake()->randomElement(['Actif', 'Inactif']),
            'categorie_id' => Categorie::factory(),
        ];
    }
}
