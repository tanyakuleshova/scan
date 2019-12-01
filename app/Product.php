<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'id','title'
    ];
    public function scanId(){
        return $this->hasMany(Scan::class);
    }
}
