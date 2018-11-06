<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sub_category extends Model
{
    //
    public function Category(){
        return $this->belongsTo('App\Models\Category');
    }
    public function Product(){
        return $this->hasMany('App\Models\Product');
    }
}
