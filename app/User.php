<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

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

    public function rank(){

        return $this->belongsTo(Rank::class);
        //, 'rank_id', 'id'
    }

    public function paymenttypes(){

        return $this->belongsTo(PaymentType::class, 'payment_type_id', 'id');
    }

 

    public function orders(){

        return $this->hasMany(Order::class);
    }

    public function ordersPosted(){

        return $this->hasMany(Order::class, 'reqfrom', 'id');
    }

    public function getCreditAmount(){
        
        $credit_orders = Order::where('user_id', $this->id)
            ->where('payment_type_id', 2)
            ->where('status', 4)
            ->where('payment_status', false)
            ->select('amount', DB::raw('sum(amount) as amount_sum'))
            ->get();

        return number_format($credit_orders[0]->amount_sum, 3);
    }

    public function getTotalCreditAttribute(){

        return number_format($this->limit - $this->getCreditAmount() , 3);
    }

    public function category(){

        return $this->belongsTo(MemberCategory::class, 'category_id');
        
    }

    public function branch(){

        return $this->belongsTo(Branch::class);
    }

    public function branches(){

        return $this->belongsToMany(Branch::class);
    }

    public function getOrderStatus($dt){

        $date = explode('T', $dt);
        $date = $date[0];

        $nub = $this->hasMany(Order::class)
            ->whereDate('delivery_time', '=', $date)
            //->whereDate('created_at', '2016-12-31')
            ->count();

        if($this->item_limit <= $nub){

            return response(['msg' => 'Limit exced! Only '.$this->item_limit.' items allowed for this date'] , 200);
        }
        else{
            return response(['msg' => 'ok', 'dt' => $nub] , 200);
        }
    }

    public function debits(){

        return $this->hasMany(MemberPay::class);
    }

    //renewals
    public function renewals(){

        return $this->hasMany(MemberRenewal::class);
    }

    public function settlements(){

        return $this->hasMany(Settlement::class);

        
    }


    //selletment biller
    public function biller(){

        return $this->settlements()
        ->where('status', true)
        ->where('branch_id', Session::get('branch')->id)
        ->get();

        
    }
}
