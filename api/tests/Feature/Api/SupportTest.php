<?php

namespace Api;

use App\Models\Lesson;
use App\Models\Support;
use App\Traits\TestTrait;
use Tests\TestCase;

/**
 *
 */
class SupportTest extends TestCase
{
    use TestTrait;

    /**
     * @return void
     */
    public function test_get_my_supports_unauthenticated(): void
    {
        $response = $this->getJson('/supports/me');

        $response->assertStatus(401);
    }

    /**
     * @return void
     */
    public function test_get_my_supports(): void
    {
        $user = $this->createUser();
        $token = $user->createToken('teste')->plainTextToken;

        Support::factory()->count(50)->create([
            'user_id' => $user->id,
        ]);

        Support::factory()->count(50)->create();

        $response = $this->getJson('/supports/me', [
            'Authorization' => "Bearer {$token}"
        ]);

        $response->assertStatus(200)
            ->assertJsonCount(50, 'data');
    }

    /**
     * @return void
     */
    public function test_get_supports_unauthenticated(): void
    {
        $response = $this->getJson('/supports');

        $response->assertStatus(401);
    }

    /**
     * @return void
     */
    public function test_get_supports(): void
    {
        Support::factory()->count(50)->create();

        $response = $this->getJson('/supports', $this->defaultHeaders());

        $response->assertStatus(200)
            ->assertJsonCount(50, 'data');
    }

    /**
     * @return void
     */
    public function test_get_supports_filter_lesson(): void
    {
        $lesson = Lesson::factory()->create();

        Support::factory()->count(50)->create();
        Support::factory()->count(10)->create([
            'lesson_id' => $lesson->id,
        ]);

        $payload = ['lesson' => $lesson->id];

        $response = $this->json('GET', '/supports', $payload, $this->defaultHeaders());

        $response->assertStatus(200)
            ->assertJsonCount(10, 'data');
    }

    /**
     * @return void
     */
    public function test_create_support_unauthenticated(): void
    {
        $response = $this->postJson('/supports');

        $response->assertStatus(401);
    }

    /**
     * @return void
     */
    public function test_create_support_error_validations(): void
    {
        $response = $this->postJson('/supports', [], $this->defaultHeaders());

        $response->assertStatus(422);
    }

    /**
     * @return void
     */
    public function test_create_support(): void
    {
        $lesson = Lesson::factory()->create();

        $payload = [
            'lesson' => $lesson->id,
            'status' => 'P',
            'description' => 'Description Test',
            'title' => 'Title name test'
        ];

        $response = $this->postJson('/supports', $payload, $this->defaultHeaders());

        $response->assertStatus(201);
    }
}
