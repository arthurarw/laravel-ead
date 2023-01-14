<?php

namespace App\Repositories;

use App\Models\Lesson;
use App\Models\Module;
use Illuminate\Database\Eloquent\Collection;

/**
 *
 */
class LessonRepository
{
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
        return $this->entity->where('module_id', '=', $module->id)
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

}
