<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class SupportResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'status' => $this->status,
            'status_label' => $this->statusOptions[$this->status],
            'user' => new UserResource($this->user),
            'lesson' => new LessonResource($this->whenLoaded('lessons')),
            //'replies' => ReplySupportResource::collection($this->whenLoaded('replies')),
            'replies' => ReplySupportResource::collection($this->replies),
            'updated_at' => Carbon::make($this->updated_at)->format('d/m/Y H:i:s')
        ];
    }
}
