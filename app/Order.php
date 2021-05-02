<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

  



    protected $guarded = [];

    public function user(){

        return $this->belongsTo(User::class);
    }

    public function location(){

        return $this->belongsTo(Deliverylocation::class, 'deliverylocation_id', 'id');
    }

    public function table(){

        return $this->belongsTo(Table::class);
    }

    public function products(){

        return $this->belongsToMany(Product::class)->withPivot('product_id', 'quantity');
    }

    // public function getDeliveryTime(){

    //     return Carbon::parse($this->delivery_time)->format('g:i A');
    // }
}
