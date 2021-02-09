<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FCProductInfo extends Model
{
    /**
	* The database name used by the model.
	*
	* @var string
	*/
	protected $connection = 'mysql_master';
	/**
	* The database table used by the model.
	*
	* @var string
	*/
	protected $table = 'fc_productinfo';
	/**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'ProductID';
	/**
     * Get the condition for the product.
     */
    public function productdiscountRule()
    {
        return $this->hasMany('App\ProductNonClubDiscountDifference');
    }
}
