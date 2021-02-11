<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExcludedProducts extends Model
{
  
	protected $connection = 'mysql_commonmaster';	
	protected $table = 'excludeproductid';
	public $timestamps=false;

}
