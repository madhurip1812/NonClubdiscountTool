<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
	* The database name used by the model.
	*
	* @var string
	*/
	/*** For PG ***/
	protected $connection = 'server_pgsql';

	/*** For Mysql ***/
	//protected $connection = 'mysql_master';

	/**
	* The database table used by the model.
	*
	* @var string
	*/
	/*** For PG ***/
	protected $table = 'productnonclubdiscount.category';

	/*** For Mysql ***/
	//protected $table = 'category';
	
	/**
     * Get the subcategory for the category.
     */
    public function subcategory()
    {
        return $this->hasMany('App\SubCategory', 'productcatid', 'productcatid');
    }
	
	/**
     * Get the condition for the category.
     */
    public function catdiscountRule()
    {
        return $this->hasMany('App\NonClubDiscountDifferenceConditions','categoryid','productcatid');
    }
}
