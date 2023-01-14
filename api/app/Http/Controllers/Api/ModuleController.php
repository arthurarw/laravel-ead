<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ModuleResource;
use App\Models\Course;
use App\Repositories\ModuleRepository;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ModuleController extends Controller
{
    public function __construct(protected ModuleRepository $repository)
    {
    }

    public function index(Course $course): AnonymousResourceCollection
    {
        return ModuleResource::collection($this->repository->getModulesCourseById($course));
    }
}
