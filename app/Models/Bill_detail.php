<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill_detail extends Model
{
    use HasFactory;

    public function buses()
    {
        return $this->hasOne(Buses::class,'id','buses_id');
    }
}
