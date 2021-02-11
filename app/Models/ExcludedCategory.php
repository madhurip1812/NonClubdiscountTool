<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExcludedCategory extends Model
{
   
	protected $connection = 'mysql_commonmaster';	
	protected $table = 'excludecategoryid';
	public $timestamps=false;

}
