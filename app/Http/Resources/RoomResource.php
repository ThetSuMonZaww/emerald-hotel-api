<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RoomResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'room_type' => $this->room_type,
            'room_number' => $this->room_number,
            'room_description' => $this->room_description,
            'service' => $this->service,
            'special' => $this->special,
            'bed_type' => $this->bed_type,
            'size' => $this->size,
            'adult' => $this->adult,
            'child' => $this->child,
            'bathroom' => $this->bathroom,
            'view' => $this->view,
            'price' => $this->price,
            'status' => $this->status,
             // Include the associated images
             'images' => ImageResource::collection($this->images),
        ];
    }
}
