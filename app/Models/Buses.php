<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Buses
 *
 * @property int $id
 * @property int $route_driver_car_id
 * @property string $departure_time
 * @property int|null $status
 * @property int $slot
 * @property int $price
 * @property-read \App\Models\Route_driver_car $route_driver_car
 * @method static \Database\Factories\BusesFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Buses newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Buses newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Buses query()
 * @method static \Illuminate\Database\Eloquent\Builder|Buses whereDepartureTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Buses whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Buses wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Buses whereRouteDriverCarId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Buses whereSlot($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Buses whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Buses indexHomePage($filters)
 * @mixin \Eloquent
 */
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
