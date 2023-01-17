<?php

namespace App\Repositories;

use App\Models\Support;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 *
 */
class SupportRepository
{
    /**
     * @param Support $entity
     */
    public function __construct(protected Support $entity)
    {
    }

    /**
     * @param array $filters
     * @return Collection|array
     */
    public function getSupports(array $filters = []): Collection|array
    {
        return $this->getUserAuth()
            ->supports()
            ->where(function ($query) use ($filters) {
                if (!empty($filters['lesson'])) {
                    $query->where('lesson_id', $filters['lesson']);
                }

                if (!empty($filters['status'])) {
                    $query->where('status', $filters['status']);
                }

                if (!empty($filters['filter'])) {
                    $query->where('description', 'LIKE', "%{$filters['filter']}%");
                }
            })
            ->get();
    }

    /**
     * @param array $data
     * @return Model
     */
    public function createNewSupport(array $data): Model
    {
        return $this->getUserAuth()->supports()->create([
            'lesson_id' => $data['lesson'],
            'description' => $data['description'],
            'title' => $data['title'],
            'status' => $data['status']
        ]);
    }

    public function createReplyBySupportId(Support $support, array $data): Model
    {
        $user = $this->getUserAuth();

        return $support->replies()
            ->create([
                'description' => $data['description'],
                'user_id' => $user->id,
                'lesson_id' => $support->lesson_id
            ]);
    }

    /**
     * @return User
     */
    private function getUserAuth(): User
    {
//        return auth()->user();
        return User::first();
    }

}
