<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $fillable =[
        "name",
    ];

    public $timestamps = false;

    // Auto delete related row
    public static function boot() {
        parent::boot();

        static::deleting(function($city) {
            $city->routes()->get()->each->delete();
            $city->location()->get()->each->delete();
        });
    }

    public function routes()
    {
        return $this->hasMany(Route::class);
    }

    public function location()
    {
        return $this->hasMany(Location::class);
    }
}
