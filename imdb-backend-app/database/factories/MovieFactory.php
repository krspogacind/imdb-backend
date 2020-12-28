<?php

namespace Database\Factories;

use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Database\Eloquent\Factories\Factory;

class MovieFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Movie::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $genre_id = rand(1, Genre::all()->count());

        return [
            'title' => $this->faker->words(2, true),
            'description' => $this->faker->text(500),
            'cover_image_url' => $this->faker->imageUrl(),
            'genre_id' => $genre_id
        ];
    }
}
