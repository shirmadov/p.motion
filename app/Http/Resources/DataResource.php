<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DataResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'            => $this->data_id,
            'title'         =>  $this->title,
            'number'        =>  $this->number,
            'duration'      =>  $this->duration,
            'price'         =>  $this->price,
            'city'          => $this->city
        ];
    }
}
