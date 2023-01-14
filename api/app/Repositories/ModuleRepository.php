<?php

namespace App\Repositories;

use App\Models\Course;
use App\Models\Module;
use Illuminate\Database\Eloquent\Collection;

/**
 *
 */
class ModuleRepository
{
    /**
     * @param Module $entity
     */
    public function __construct(protected Module $entity)
    {
    }

    /**
     * @param Course $course
     * @return Collection|array
     */
    public function getModulesCourseById(Course $course): Collection|array
    {
        return $this->entity->with('course')
            ->where('course_id', '=', $course->id)
            ->get();
    }

}
