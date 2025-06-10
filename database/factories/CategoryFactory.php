<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\NewsCategory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    protected $model = NewsCategory::class;

    public function definition(): array
    {
        $name = $this->faker->unique()->randomElement([
            'Teknologi Pendidikan',
            'E-Learning',
            'Pembelajaran Online',
            'Inovasi Edukasi',
            'Digital Learning',
            'Pendidikan Masa Depan',
            'Kursus Online',
            'Edukasi Digital'
        ]);

        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'description' => $this->faker->sentence(10),
        ];
    }
}
