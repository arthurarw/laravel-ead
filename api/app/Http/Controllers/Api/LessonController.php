<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreViewRequest;
use App\Http\Resources\LessonResource;
use App\Models\Lesson;
use App\Models\Module;
use App\Repositories\LessonRepository;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class LessonController extends Controller
{
    public function __construct(protected LessonRepository $repository)
    {
    }

    public function index(Module $module): AnonymousResourceCollection
    {
        return LessonResource::collection($this->repository->getLessonsByModuleId($module));
    }

    public function show(Lesson $lesson): LessonResource
    {
        return new LessonResource($this->repository->getLessonsById($lesson));
    }

    public function viewed(StoreViewRequest $request)
    {
        $this->repository->markLessonViewed($request->validated());

        return response()->json(['success' => true]);
    }
}
