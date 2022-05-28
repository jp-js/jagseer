<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    public $fillable = ['order_id','product_id'];

     public function product()
    {
        try{
            return $this->hasOne(\App\Models\Product::class,'id','product_id');
        }catch(\Exeption $ex){
            return $ex->getMessage();
        }
    }
}
