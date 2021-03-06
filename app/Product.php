<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'amount', 'image','description',
    ];
    
    
    public function order_products(){
        return $this->hasMany(OrderProduct::class);
    }
    
}
