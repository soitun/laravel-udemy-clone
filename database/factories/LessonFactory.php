<?php

namespace Database\Factories;

use App\Lesson;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Lesson>
 */
class LessonFactory extends Factory
{
    protected $model = Lesson::class;

    public function definition(): array
    {
        $videos = [
            'https://www.youtube.com/watch?v=UnTQVlqmDQ0',
            'https://www.youtube.com/watch?v=z6hQqgvGI4Y',
            'https://www.youtube.com/watch?v=U8XF6AFGqlc',
            'https://www.youtube.com/watch?v=vEROU2XtPR8',
            'https://www.youtube.com/watch?v=pWbMrx5rVBE',
            'https://www.youtube.com/watch?v=Zftx68K-1D4',
            'https://www.youtube.com/watch?v=sard25VQ2HU',
        ];

        return [
            'title' => fake()->sentence(3),
            'course_id' => fake()->numberBetween(1, 30),
            'duration' => fake()->randomFloat(2, 1, 10),
            'video' => fake()->randomElement($videos),
        ];
    }
}
