<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Customer extends Model
{
    use HasFactory;

    protected $fillable =[
        "name",
        "phone",
        "address",
        "gender",
        "birthday",
        "email",
    ];

    public $timestamps = false;

    public function getProvincesAttribute():string
    {
        return ($this->address==null) ? '' : Str::afterLast($this->address, ',');
    }

    public function getDateVNAttribute():string
    {
        return \Carbon\Carbon::parse($this->birthdate)->format('d-m-Y');
    }

    // Auto delete related row
    public static function boot() {
        parent::boot();

        static::deleting(function($customer) {
                $customer->bills()->get()->each->delete();
        });
    }

    public function bills()
    {
        return $this->hasMany(Bill::class);
    }
}
