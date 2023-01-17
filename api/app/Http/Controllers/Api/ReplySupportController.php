<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreReplySupportRequest;
use App\Http\Resources\ReplySupportResource;
use App\Repositories\ReplySupportRepository;

class ReplySupportController extends Controller
{
    public function __construct(protected ReplySupportRepository $repository)
    {
    }

    /**
     * @param StoreReplySupportRequest $request
     * @return ReplySupportResource
     */
    public function store(StoreReplySupportRequest $request): ReplySupportResource
    {
        return new ReplySupportResource($this->repository->createReplyBySupportId($request->validated()));
    }
}
