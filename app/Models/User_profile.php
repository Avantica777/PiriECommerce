<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User_profile extends Model
{
    //
    public function User(){
        return $this->belongsTo('App\Models\User');
    }
}
