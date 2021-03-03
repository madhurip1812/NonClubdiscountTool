<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class B2BCashbackOrderMaster extends Model
{
  
	protected $connection = 'mysql_cashbackcoupondb';	
	protected $table = 'b2bcashbackordermaster';
	public $timestamps=false;
    protected $primaryKey = 'CashBackRuleName';
    // protected $fillable = ['upgradepostexpiry','upgradeplanoption','upgradedateto','upgradedatefrom','productname','productid','precartofferid','isactive'];
}
