<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buses extends Model
{
    use HasFactory;

    public function route_driver_car()
    {
        return $this->belongsTo(Route_driver_car::class, 'route_driver_car_id');
    }
    public $timestamps = false;

    protected $fillable = [
        "route_driver_car_id",
        "departure_time",
        "price",
    ];
}
