<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubscriptionCouponcodeModel extends Model
{
    protected $connection = 'mysql';
    public $table = 'cashbackintellikitmaster';
    protected $primaryKey = 'CashBackCouponID';
    public $timestamps = false;
    protected $fillable = ['CashBackCoupon','cashbackrulefor','cashbackrulename','cashbackoncoupon','cashbackoutcoupon','CouponValidityDays','CashBackPercentage','CashBackMaxAmount','CashBackOnMinmumPurchase','EmailTemplateID','CashBackStartDate','CashBackEndDate','isactive','createdby','createddate','LastModifiedBy','LastModifiedDate','productids'];

    public function subscriptionTypeDetail() {
    	return $this->hasMany('App\Models\SubscriptionTypeDetailModel','cashbackcoupon');
    }
}
