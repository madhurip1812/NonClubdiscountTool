<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductInfoWithType extends Model
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
	protected $table = 'productnonclubdiscount.productinfowithtype';

	/*** For Mysql ***/
	//protected $table = 'category';
	
	/**
     * Get the condition for the product.
     */
    public function productdiscountRule()
    {
        return $this->hasMany('App\ProductNonClubDiscountDifference');
    }
}
