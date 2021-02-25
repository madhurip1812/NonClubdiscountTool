<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PreCartOffer extends Model
{
  
	protected $connection = 'mysql_precart';	
	protected $table = 'precartoffer';
	public $timestamps=false;

}
