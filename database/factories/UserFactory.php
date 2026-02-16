<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nom' => 'Bénéwendé Sofiane Koinda',
            'slogan' => fake()->sentence(),
            'description' => fake()->paragraph(),
            'photo' => 'default-avatar.jpg',
            'tel1' => '778833937',
            'tel2' => fake()->phoneNumber(),
            'email' => 'sofianekoindakoinda1@gmail.com',
            'password' => static::$password ??= Hash::make('password'),
            'adresse' => 'Ouakam, Dakar, Sénégal',
            'poste' => fake()->jobTitle(),
            'link' => fake()->url(),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
