<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Route extends Model
{
    use HasFactory;

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
        return $this->hasMany(City::class,'id','city_start_id');
    }

    public function city_end()
    {
        return $this->hasMany(City::class,'id','city_end_id');
    }

}
