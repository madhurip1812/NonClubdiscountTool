<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BrandMaster extends Model
{
    /**
	* The database name used by the model.
	*
	* @var string
	*/
	protected $connection = 'mysql_commonmaster';
	/**
	* The database table used by the model.
	*
	* @var string
	*/
	protected $table = 'brandmaster';

}
