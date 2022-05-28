<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public $fillable = ['user_id'];

     public function order_items()
    {
        try{
            return $this->hasMany(\App\Models\OrderItem::class,'order_id','id')->with(['product']);
        }catch(\Exeption $ex){
            return $ex->getMessage();
        }
    }
    public function users()
    {
        try{
            return $this->hasOne(\App\Models\User::class,'id','user_id');
        }catch(\Exeption $ex){
            return $ex->getMessage();
        }
    }
}
