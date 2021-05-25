<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = ['total_credit'];

    

    public function getrank(){

        return Rank::where('id', $this->rank_id)->first();
        //$this->belongsTo(Rank::class, 'rank_id', 'id');
    }

    public function paymenttypes(){

        return $this->belongsTo(PaymentType::class, 'payment_type_id', 'id');
    }

    public function orders(){

        return $this->hasMany(Order::class);
    }

    public function getCreditAmount(){

        $credit_orders = $this->orders()->where('payment_type_id', 2)->get();

        $credit_total = [];

        $credit_orders->each(function($item) use(&$credit_total){

            $credit_total[] = $item->gettotalprice()['subtotal'];
        });

        return number_format(array_sum($credit_total), 3);

        //return 45.500;
    }

    public function getTotalCreditAttribute(){

        $credit_orders = $this->orders()->where('payment_type_id', 2)->get();

        $credit_total = [];

        $credit_orders->each(function($item) use(&$credit_total){

            $credit_total[] = $item->gettotalprice()['subtotal'];
        });

        return number_format(array_sum($credit_total), 3);

        //return 45.500;
    }
}
