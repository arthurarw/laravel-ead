<?php

namespace Api;

use App\Models\Course;
use App\Models\Module;
use App\Traits\TestTrait;
use Tests\TestCase;

/**
 *
 */
class ModuleTest extends TestCase
{
    use TestTrait;

    /**
     * @return void
     */
    public function test_get_modules_unauthenticated(): void
    {
        $response = $this->getJson('/courses/fake_value/modules');

        $response->assertStatus(401);
    }

    /**
     * @return void
     */
    public function test_get_modules_course_not_found(): void
    {
        $response = $this->getJson('/courses/fake_value/modules', $this->defaultHeaders());

        $response->assertStatus(404);
    }

    /**
     * @return void
     */
    public function test_get_modules_course(): void
    {
        $course = Course::factory()->create();

        $response = $this->getJson("/courses/{$course->id}/modules", $this->defaultHeaders());

        $response->assertStatus(200);
    }

    /**
     * @return void
     */
    public function test_get_modules_course_total(): void
    {
        $course = Course::factory()->create();
        Module::factory()->count(10)->create([
            'course_id' => $course->id
        ]);

        $response = $this->getJson("/courses/{$course->id}/modules", $this->defaultHeaders());

        $response->assertStatus(200)
            ->assertJsonCount(10, 'data');
    }
}
