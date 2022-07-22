<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Route_driver_car extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'route_id',
        'driver_id',
        'car_id',
        'price',
    ];
}
