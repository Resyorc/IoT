<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SensorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'device_id' => $this->device_id,
            'soil_moisture' => $this->soil_moisture,
            'humidity' => $this->humidity,
            'temperature' => $this->temperature,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}