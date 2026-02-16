<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Entreprise>
 */
class EntrepriseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $entreprises = [
            'Entreprise' => [
                'Orange Sénégal', 'Free Sénégal', 'Expresso', 'Sonatel', 'Ecobank', 'BICIS',
                'Total Sénégal', 'Shell Sénégal', 'Air Sénégal', 'Port de Dakar'
            ],
            'Ecole' => [
                'Université Cheikh Anta Diop', 'École Supérieure Polytechnique', 'ISEP',
                'ESMT', 'ENCR', 'ENAM', 'ENEA', 'Université Gaston Berger'
            ]
        ];

        $type = fake()->randomElement(['Entreprise', 'Ecole']);
        $nom = fake()->randomElement($entreprises[$type]);

        return [
            'nom' => $nom,
            'adresse' => fake()->address(),
            'tel1' => fake()->phoneNumber(),
            'tel2' => fake()->phoneNumber(),
            'site' => fake()->url(),
            'email' => fake()->companyEmail(),
            'type' => $type,
            'etat' => fake()->randomElement(['Actif', 'Inactif']),
        ];
    }
}
