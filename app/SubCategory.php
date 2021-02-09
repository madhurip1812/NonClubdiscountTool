<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
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
	protected $table = 'productnonclubdiscount.subcategory';

	/*** For Mysql ***/
	//protected $table = 'subcategory';

	/**
	* The attributes that are mass assignable.
	*
	* @var array
	*/
	// protected $fillable = ['firstname', 'lastname', 'username', 'nickname', 'password'];

	/**
     * Get the category that owns the subcategory.
     */
    public function category()
    {
        return $this->belongsTo('App\Category', 'productcatid', 'productcatid');
    }

    /**
     * Get the condition for the subcategory.
     */
    public function subcatdiscountRule()
    {
        return $this->hasMany('App\NonClubDiscountDifferenceConditions', 'subcategoryid', 'subcatid');
    }	
}
