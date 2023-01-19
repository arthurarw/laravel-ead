<?php

namespace Api;

use App\Models\Lesson;
use App\Models\Support;
use App\Traits\TestTrait;
use Tests\TestCase;

/**
 *
 */
class ReplySupportTest extends TestCase
{
    use TestTrait;

    /**
     * @return void
     */
    public function test_create_reply_to_support_unauthenticated(): void
    {
        $response = $this->postJson('/replies');

        $response->assertStatus(401);
    }

    /**
     * @return void
     */
    public function test_create_reply_to_support_error_validations(): void
    {
        $response = $this->postJson('/replies', [], $this->defaultHeaders());

        $response->assertStatus(422);
    }

    /**
     * @return void
     */
    public function test_create_reply_to_support(): void
    {
        $support = Support::factory()->create();
        $lesson = Lesson::factory()->create();

        $payload = [
            'title' => 'teste 3123',
            'support' => $support->id,
            'lesson' => $lesson->id,
            'description' => 'test description reply support',
        ];

        $response = $this->postJson('/replies', $payload, $this->defaultHeaders());

        $response->assertStatus(201);
    }
}
