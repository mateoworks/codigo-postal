<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MunicipalityResource extends JsonResource
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
            'nombre' => $this->name,
            'estado' => StateResource::make($this->whenLoaded('state')),
            'asentamientos' => SuburbResource::collection($this->whenLoaded('suburbs')),
        ];
    }
}
