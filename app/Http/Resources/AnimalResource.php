<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AnimalResource extends JsonResource
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
            'name' => $this->name,
            'species' => $this->species->name,
            'breed' => $this->breed->name,
            'age' => $this->ageString,
            'image' => $this->firstImage,
            'images' => $this->images,
            'gender' => $this->gender->getLabel(),
            'color' => $this->color,
            'description' => $this->description,
        ];
    }
}
