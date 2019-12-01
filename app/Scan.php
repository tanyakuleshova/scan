<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Scan extends Model
{
    public function productId(){
        return $this->belongsTo(Product::class);
    }

}
