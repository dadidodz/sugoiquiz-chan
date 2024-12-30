<?php

namespace Database\Factories;

use App\Models\Music;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Music>
 */
class MusicFactory extends Factory
{
    protected $model = Music::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(3), // Un titre aléatoire de 3 mots
            'file' => $this->faker->word . '.mp3', // Un fichier aléatoire
            'duration' => $this->faker->numberBetween(180, 360), // Durée aléatoire entre 3 et 6 minutes
            'animes_id' => $this->faker->numberBetween(1, 20), // Lier un anime aléatoire avec un ID entre 1 et 20
        ];
    }
}
