<?php

namespace Database\Factories;

use App\Models\Support;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Support>
 */
class SupportFactory extends Factory
{

    /**
     * @var string
     */
    protected $model = Support::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => '30818c66-205e-43e4-909c-513bbc825359',
            'lesson_id' => '2123157e-c671-42d6-bd15-052549382198',
            'description' => $this->faker->text,
            'status' => 'P'
        ];
    }
}
