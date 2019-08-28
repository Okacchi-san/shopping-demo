<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    protected $fillable = [
        'order_id', 'product_id', 
        'qty',
    ];
    
    public function order(){
        return $this->belongsTo(Oder::class);
    }
    
    public function product(){
        return $this->belongsTo(Product::class);
    }
    
}
