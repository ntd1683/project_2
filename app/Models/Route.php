<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Route extends Model
{
    use HasFactory;

    protected $fillable =[
        "city_start_id",
        "city_end_id",
        "name",
        "time",
        "distance",
        "images",
        "pin",
    ];

    public $timestamps = false;

    public function getDistanceNameAttribute():string
    {
        return (!$this->distance) ? 0 : $this->distance . ' km';
    }

    public function getTimeNameAttribute():string
    {
        return (!$this->time) ? 0 : $this->time . 'h';
    }

    public function city_start()
    {
        return $this->belongsTo(City::class,'city_start_id');
    }

    public function city_end()
    {
        return $this->belongsTo(City::class,'city_end_id');
    }
}
