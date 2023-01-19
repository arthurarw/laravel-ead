<?php

namespace Tests\Feature\Api;

use App\Models\Lesson;
use App\Models\Module;
use App\Traits\TestTrait;
use Tests\TestCase;

/**
 *
 */
class LessonTest extends TestCase
{
    use TestTrait;

    /**
     * @return void
     */
    public function test_get_lessons_unauthenticated(): void
    {
        $response = $this->getJson('/modules/fake_value/lessons');

        $response->assertStatus(401);
    }

    /**
     * @return void
     */
    public function test_get_lessons_of_module_not_found(): void
    {
        $response = $this->getJson('/modules/fake_value/lessons', $this->defaultHeaders());

        $response->assertStatus(404);
    }

    /**
     * @return void
     */
    public function test_get_lessons_module(): void
    {
        $module = Module::factory()->create();
        Lesson::factory()->count(10)->create([
            'module_id' => $module->id
        ]);
        $response = $this->getJson("/modules/{$module->id}/lessons", $this->defaultHeaders());

        $response->assertStatus(200);
    }

    /**
     * @return void
     */
    public function test_get_lessons_of_module_total(): void
    {
        $module = Module::factory()->create();
        Lesson::factory()->count(10)->create([
            'module_id' => $module->id
        ]);

        $response = $this->getJson("/modules/{$module->id}/lessons", $this->defaultHeaders());

        $response->assertStatus(200)
            ->assertJsonCount(10, 'data');
    }

    /**
     * @return void
     */
    public function test_get_single_lesson_unauthenticated(): void
    {
        $response = $this->getJson('/lessons/fake_value');

        $response->assertStatus(401);
    }

    /**
     * @return void
     */
    public function test_get_single_lesson_not_found(): void
    {
        $response = $this->getJson('/lessons/fake_value', $this->defaultHeaders());

        $response->assertStatus(404);
    }

    /**
     * @return void
     */
    public function test_get_single_lesson(): void
    {
        $lesson = Lesson::factory()->create();

        $response = $this->getJson("/lessons/{$lesson->id}", $this->defaultHeaders());

        $response->assertStatus(200);
    }
}
