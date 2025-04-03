<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'category_id' => $this->category_id,
            'prodect_id' => $this->prodect_id,
            'store_id' => $this->store_id,
            'imageItem' => ImageItemResource::collection($this->imageItem),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            ];

    }
}
