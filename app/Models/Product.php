<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    public function Sub_category(){
        return $this->belongsTo('App\Models\Sub_category');
    }
}
