<?php

namespace Tests\Feature\Api\Auth;

use App\Models\User;
use App\Traits\TestTrait;
use Tests\TestCase;

/**
 *
 */
class AuthTest extends TestCase
{
    use TestTrait;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_fail_auth(): void
    {
        $response = $this->postJson('/auth', []);

        $response->assertStatus(422);
    }

    /**
     * @return void
     */
    public function test_auth(): void
    {
        $user = User::factory()->create();

        $response = $this->postJson('/auth', [
            'email' => $user->email,
            'password' => 'password',
            'device_name' => 'Teste'
        ]);

        $response->assertStatus(200);
    }

    /**
     * @return void
     */
    public function test_fail_logout(): void
    {
        $response = $this->postJson('/auth/logout', []);

        $response->assertStatus(401);
    }

    public function test_logout(): void
    {
        $token = $this->createTokenUser();

        $response = $this->postJson('/auth/logout', [], [
            'Authorization' => "Bearer {$token}"
        ]);

        $response->assertStatus(200);
    }

    public function test_fail_me(): void
    {
        $response = $this->getJson('/me');

        $response->assertStatus(401);
    }

    public function test_me(): void
    {
        $token = $this->createTokenUser();

        $response = $this->getJson('/me', [
            'Authorization' => "Bearer {$token}"
        ]);

        $response->assertStatus(200);
    }
}
