<?php

namespace App\Repositories;

use App\Models\Course;
use Illuminate\Database\Eloquent\Collection;

/**
 *
 */
class CourseRepository
{
    /**
     * @param Course $entity
     */
    public function __construct(protected Course $entity)
    {
    }

    /**
     * @return Collection|array
     */
    public function getAllCourses(): Collection|array
    {
        return $this->entity->with('modules.lessons.views')->get();
    }

    /**
     * @param Course $course
     * @return mixed
     */
    public function getCourse(Course $course): mixed
    {
        return $this->entity->with('modules.lessons')->findOrFail($course->id);
    }

}
