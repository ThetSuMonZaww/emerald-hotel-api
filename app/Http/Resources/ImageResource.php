<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ImageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'image' => $this->image,  // Assuming your image has a URL column
            'imageable_type' => $this->imageable_type,  // Type of related model (e.g., Profile, Post)
            'imageable_id' => $this->imageable_id,    // ID of related model
        ];
    }
}
