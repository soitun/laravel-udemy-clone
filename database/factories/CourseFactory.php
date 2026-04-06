<?php

namespace Database\Factories;

use App\Course;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Course>
 */
class CourseFactory extends Factory
{
    protected $model = Course::class;

    public function definition(): array
    {
        return [
            'title' => fake()->sentence(4),
            'short_description' => fake()->realText(100),
            'description' => fake()->realText(),
            'outcomes' => fake()->text(5),
            'section' => fake()->text(10),
            'requirements' => 'Python, Linux, Basic Programming',
            'language' => 'English',
            'price' => fake()->numberBetween(100, 150),
            'level' => 'Beginner',
            'thumbnail' => null,
            'video_url' => null,
            'visibility' => true,
            'category_id' => fake()->numberBetween(1, 10),
        ];
    }
}
