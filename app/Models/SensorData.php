<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SensorData extends Model
{
    use HasFactory;

    protected $fillable = ['sensor_id', 'average_soil_moisture', 'average_humidity', 'average_temperature'];

    public function sensor(){
        return $this->belongsTo(Sensor::class);
    }
}
