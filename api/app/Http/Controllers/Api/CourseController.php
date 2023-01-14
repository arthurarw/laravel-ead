<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CourseResource;
use App\Models\Course;
use App\Repositories\CourseRepository;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 *
 */
class CourseController extends Controller
{
    public function __construct(protected CourseRepository $repository)
    {
    }

    /**
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return CourseResource::collection($this->repository->getAllCourses());
    }

    /**
     * @param Course $course
     * @return CourseResource
     */
    public function show(Course $course): CourseResource
    {
        return new CourseResource($this->repository->getCourse($course));
    }
}
