<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Categorie>
 */
class CategorieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categories = [
            'Application Web', 'Application Mobile', 'Site E-commerce', 'API REST',
            'Dashboard Admin', 'Système de Gestion', 'Portfolio', 'Design',
            'Application Desktop', 'Intelligence Artificielle'
        ];

        return [
            'nom' => fake()->randomElement($categories),
        ];
    }
}
