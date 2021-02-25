<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FitJuniorPlanRule extends Model
{
  
	protected $connection = 'mysql_precart';	
	protected $table = 'fitjuniorplanrule';
	public $timestamps=false;
    protected $primaryKey = 'productid';

}
