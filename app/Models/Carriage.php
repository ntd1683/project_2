<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Carriage extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $timestamps = false;

    protected $fillable = [
        'license_plate',
        'category',
        'seat_type',
        'default_number_seat',
        'color',
    ];

    // Auto delete related row
    public static function boot() {
        parent::boot();

        static::deleting(function($carriage) {
            $carriage->RDCs()->get()->each->delete();
        });
    }

    public function RDCs()
    {
        return $this->hasMany(Route_driver_car::class, 'car_id', 'id');
    }
}
