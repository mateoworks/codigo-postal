<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SuburbResource extends JsonResource
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
            'cp' => $this->cp,
            'nombre' => $this->name,
            'tipo_asentamiento' => SettlementResource::make($this->whenLoaded('settlement')),
            'ciudad' => CityResource::make($this->whenLoaded('city')),
            'municipio' => MunicipalityResource::make($this->whenLoaded('municipality')),
            'estado' => StateResource::make($this->whenLoaded('municipality.state')),
        ];
    }
}
