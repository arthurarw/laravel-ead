<?php

namespace App\Traits;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 *
 */
trait TestTrait
{
    /**
     * @return Collection|Model
     */
    public function createUser(): Model|Collection
    {
        $user = User::factory()->create();

        return $user;
    }

    /**
     * @return mixed
     */
    public function createTokenUser(): mixed
    {
        $user = $this->createUser();

        return $user->createToken('teste')->plainTextToken;
    }

    /**
     * @return string[]
     */
    public function defaultHeaders(): array
    {
        $token = $this->createTokenUser();

        return [
            'Authorization' => "Bearer {$token}",
        ];
    }
}
