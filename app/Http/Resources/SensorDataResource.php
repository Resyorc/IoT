<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SensorDataResource extends JsonResource
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
            'sensor_id' => $this->sensor_id,
            'timestamp' => $this->timestamp,
            'temperature' => $this->temperature,
            'humidity' => $this->humidity,
            'soil_moisture' => $this->soil_moisture,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
