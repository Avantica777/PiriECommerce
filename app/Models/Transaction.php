<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    //
    public function User(){
        return $this->belongsTo('App\Models\User');
    }
}
