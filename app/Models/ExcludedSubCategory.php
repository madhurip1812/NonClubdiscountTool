<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExcludedSubCategory extends Model
{
   
	protected $connection = 'mysql_commonmaster';	
	protected $table = 'excludesubcategoryid';
	public $timestamps=false;

}
