<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Créer une instance de Faker
        $faker = Faker::create();

        // Créer 10 utilisateurs avec des données aléatoires
        foreach (range(1, 10) as $index) {
            User::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => bcrypt('password'),  // Tu peux utiliser un mot de passe fixe ou générer un autre mot de passe
                'remember_token' => $faker->uuid,
            ]);
        }
    }
}
