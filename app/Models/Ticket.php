<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable =[
        "city_start_id",
        "city_end_id",
        "name",
        "time",
        "distance",
        "images",
    ];
}
