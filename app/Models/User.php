<?php

namespace App\Models;

use App\Enums\UserLevelEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model implements AuthenticatableContract
{
    use Authenticatable;
    use Notifiable;
    use HasFactory;
    use SoftDeletes;

    public $timestamps = false;

    protected $fillable =[
        "name",
        "phone",
        "address",
        "gender",
        "birthdate",
        "email",
        "level"
    ];

    public function getGenderNameAttribute():string
    {
        return ($this->gender === 0) ? 'Nữ' : 'Nam';
    }

    public function getDateVNAttribute():string
    {
        return \Carbon\Carbon::parse($this->birthdate)->format('d-m-Y');
    }

    public function getSrcImageLevelAttribute():string
    {
        $level_name = UserLevelEnum::getKey($this->level);
        $src = 'images/' . Str::lower($level_name)  .'.png';
        return $src;
    }

    public function getProvincesAttribute():string
    {
        return Str::afterLast($this->address, ',');
    }
}
