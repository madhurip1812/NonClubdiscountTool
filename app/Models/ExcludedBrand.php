<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExcludedBrand extends Model
{
   
	protected $connection = 'mysql_commonmaster';	
	protected $table = 'excludebrandid';
	public $timestamps=false;

}
