<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Route_driver_car extends Model
{
    use HasFactory;


    public function driver_name()
    {
        return $this->hasMany(User::class, 'id', 'driver_id');
    }

    public function car_name()
    {
        return $this->hasMany(Carriage::class, 'id', 'car_id');
    }

    public function route()
    {
        return $this->hasMany(Route::class, 'id', 'route_id');
    }

    public $timestamps = false;

    protected $fillable = [
        'route_id',
        'driver_id',
        'car_id',
        'price',
    ];

    // Auto delete related row
    public static function boot() {
        parent::boot();

        static::deleting(function($RDC) {
                $RDC->buses()->get()->each->delete();
        });
    }

    public function buses()
    {
        return $this->hasMany(Buses::class);
    }
}
