<?php

namespace App\Repositories;

use App\Models\Lesson;
use App\Models\Module;
use App\Repositories\Traits\RepositoryTrait;
use Illuminate\Database\Eloquent\Collection;

/**
 *
 */
class LessonRepository
{
    use RepositoryTrait;

    /**
     * @param Lesson $entity
     */
    public function __construct(protected Lesson $entity)
    {
    }

    /**
     * @param Module $module
     * @return Collection|array
     */
    public function getLessonsByModuleId(Module $module): Collection|array
    {
        return $this->entity->with('supports.replies')->where('module_id', '=', $module->id)
            ->get();
    }

    /**
     * @param Lesson $lesson
     * @return mixed
     */
    public function getLessonsById(Lesson $lesson): mixed
    {
        return $this->entity->where('id', '=', $lesson->id)->firstOrFail();
    }


    /**
     * @param array $data
     * @return mixed
     */
    public function markLessonViewed(array $data): mixed
    {
        $user = $this->getUserAuth();
        $view = $user->views()->where('lesson_id', $data['lesson'])->first();
        if ($view) {
            return $view->update([
                'quantity_views' => $view->quantity_views + 1
            ]);
        }

        return $user->views()->create([
            'lesson_id' => $data['lesson']
        ]);
    }

}
