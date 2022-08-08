<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable =[
        "bill_detail_id",
        "code",
        "name_passenger",
        "phone_passenger",
        "email_passenger",
        "address_passenger_id",
    ];
}
