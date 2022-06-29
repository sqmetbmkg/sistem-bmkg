<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StasiunResources extends JsonResource
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
            'wmo_id' => $this->wmo_id,
            'nama_stasiun' => $this->nama_stasiun,
            'longitude' => $this->longitude,
            'latitude' => $this->latitude
        ];
    }
}
