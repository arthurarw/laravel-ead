<?php

namespace App\Repositories;

use App\Models\Support;
use App\Repositories\Traits\RepositoryTrait;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 *
 */
class SupportRepository
{
    use RepositoryTrait;

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
        return $this->entity
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

                if (!empty($filters['user'])) {
                    $user = $this->getUserAuth();
                    $query->where('user_id', $user->id);
                }
            })
            ->orderBy('updated_at')
            ->get();
    }

    /**
     * @param array $filters
     * @return Collection|array
     */
    public function getMySupports(array $filters = []): Collection|array
    {
        $filters['user'] = true;
        return $this->getSupports($filters);
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

    /**
     * @param Support $support
     * @param array $data
     * @return Model
     */
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
}
