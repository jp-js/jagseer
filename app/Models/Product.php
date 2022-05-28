<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $fillable = ['name','qty','price','image','description'];


    public function getImageAttribute($value){
        if($value != null){
            return env('APP_URL').'uploads/products/'.$value;
        }else{
            return $value;
        }
    }
}
