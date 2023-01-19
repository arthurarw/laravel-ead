<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class ReplySupportResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'description' => $this->description,
            'user' => new UserResource($this->user),
            'support' => new SupportResource($this->whenLoaded('support')),
            'created_at' => Carbon::createFromFormat('Y-m-d H:i:s', $this->created_at)
                ->format('d/m/Y H:i:s')
        ];
    }
}
