<?php

namespace App\Repositories;

use App\Models\Course;

class CourseRepository
{
    public function __construct(protected Course $entity)
    {
    }

    public function getAllCourses()
    {
        return $this->entity->get();
    }

    public function getCourse(Course $course)
    {
        return $this->entity->findOrFail($course->id);
    }

}
