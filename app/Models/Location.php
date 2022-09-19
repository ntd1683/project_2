<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Location extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function city()
    {
        return $this->hasOne(City::class,'id','city_id');
    }

    protected $fillable =[
        "name",
        "address",
        "district",
        "city_id",
    ];
    public $timestamps = false;

}
