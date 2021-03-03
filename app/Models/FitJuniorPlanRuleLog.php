<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FitJuniorPlanRuleLog extends Model
{
  
	protected $connection = 'mysql_precart';	
	protected $table = 'fitjuniorplanrulelog';
	public $timestamps=false;
	protected $fillable = ['upgradepostexpiry','upgradeplanoption','upgradedateto','upgradedatefrom','productname','productid','precartofferid','isactive'];
}
