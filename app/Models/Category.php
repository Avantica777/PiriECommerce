<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    public function Sub_category(){
        return $this->hasMany('App\Models\Sub_category');
    }
}
