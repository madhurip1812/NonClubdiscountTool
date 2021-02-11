<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubscriptionTypeDetailModel extends Model
{
    protected $connection = 'mysql';
    public $table = 'subscriptiontypedetail';
    protected $primaryKey = 'subscriptiontypedetailid';
    public $timestamps = false;
    protected $fillable = ['subscriptioncouponcodeid','subscriptiontype','subscriptionboxno','isactive'];

    public function subscriptionCouponCode() {
    	return $this->belongsTo('App\Models\SubscriptionCouponcodeModel');
    }
}
