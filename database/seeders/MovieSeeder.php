<?php

namespace Database\Seeders;

use App\Models\Movie;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Movie::insert([
            'genre_id' => 1,
            'title' => 'Avatar',
            'photo' => 'img/avatar.jpg',
            'publish_date' => fake()->date(max: 'now'),
            'description' => fake()->text(100),

        ]);

        Movie::insert([
            'genre_id' => 2,
            'title' => 'Joker',
            'photo' => 'img/joker.jpg',
            'publish_date' => fake()->date(max: 'now'),
            'description' => fake()->text(100),

        ]);

        Movie::insert([
            'genre_id' => 1,
            'title' => 'Titanic',
            'photo' => 'img/titanic.jpg',
            'publish_date' => fake()->date(max: 'now'),
            'description' => fake()->text(100),

        ]);

        Movie::insert([
            'genre_id' => 2,
            'title' => 'Star Wars',
            'photo' => 'img/starwars.jpg',
            'publish_date' => fake()->date(max: 'now'),
            'description' => fake()->text(100),

        ]);
    }
}
