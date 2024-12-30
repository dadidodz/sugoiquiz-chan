<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Anime>
 */
class AnimeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(3), // Titre de 3 mots
            'description' => $this->faker->paragraph(4), // 4 phrases
            'image' => $this->faker->imageUrl(640, 480, 'anime', true, 'Faker'), // URL d'image fictive
            'release_date' => $this->faker->date(), // Date aléatoire
            'details' => json_encode([
                'rating' => $this->faker->randomFloat(1, 7, 10), // Note entre 7.0 et 10.0
                'episodes' => $this->faker->numberBetween(12, 100), // Nombre d'épisodes
                'studio' => $this->faker->company(), // Nom du studio
            ]),
        ];
    }
}
