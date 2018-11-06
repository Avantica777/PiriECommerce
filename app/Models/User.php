<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    //
    public function User_profile(){
        return $this->hasOne('App\Models\User_profile');
    }
    public function Transaction(){
        return $this->hasMany('App\Models\Transaction');
    }
    public function Review(){
        return $this->hasMany('App\Models\Review');
    }
}
