<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSupportRequest;
use App\Http\Resources\SupportResource;
use App\Models\Support;
use App\Repositories\SupportRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 *
 */
class SupportController extends Controller
{
    /**
     * @param SupportRepository $repository
     */
    public function __construct(protected SupportRepository $repository)
    {
    }

    /**
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        return SupportResource::collection($this->repository->getSupports($request->all()));
    }

    public function mySupports(Request $request): AnonymousResourceCollection
    {
        return SupportResource::collection($this->repository->getMySupports($request->all()));
    }

    /**
     * @param StoreSupportRequest $request
     * @return SupportResource
     */
    public function store(StoreSupportRequest $request): SupportResource
    {
        return new SupportResource($this->repository->createNewSupport($request->validated()));
    }

    /**
     * @param Support $support
     * @return void
     */
    public function getReplies(Support $support)
    {
        abort(404);
    }
}
