<?php

namespace App\Repositories;

use App\Models\ReplySupport;
use App\Repositories\Traits\RepositoryTrait;
use Illuminate\Database\Eloquent\Model;

/**
 *
 */
class ReplySupportRepository
{
    use RepositoryTrait;

    /**
     * @param ReplySupport $entity
     */
    public function __construct(protected ReplySupport $entity)
    {
    }

    public function createReplyBySupportId(array $data): Model
    {
        $user = $this->getUserAuth();

        return $this->entity->create([
            'description' => $data['description'],
            'user_id' => $user->id,
            'lesson_id' => $data['lesson'],
            'support_id' => $data['support']
        ]);
    }
}
