<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;

    protected $fillable =[
        "customer_id",
        "code",
        "price",
        "payment_method",
        "status",
    ];

    public function customer_name()
    {
        return $this->hasOne(Customer::class,'id','customer_id');
    }

    // Auto delete related row
    public static function boot() {
        parent::boot();

        static::deleting(function($bill) {
                $bill->billDetails()->get()->each->delete();
        });
    }

    public function billDetails()
    {
        return $this->hasMany(Bill_detail::class);
    }
}
