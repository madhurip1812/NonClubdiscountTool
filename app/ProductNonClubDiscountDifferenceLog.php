<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductNonClubDiscountDifferenceLog extends Model
{
    /**
	* The database name used by the model.
	*
	* @var string
	*/
	protected $connection = 'server_pgsql';
	/**
	* The database table used by the model.
	*
	* @var string
	*/
	protected $table = 'productnonclubdiscount.productnonclubdiscountdifference_log';

	/**
     * Get the category that owns the condition.
     */

    /**
	* The attributes that are mass assignable.
	*
	* @var array
	*/

	protected $fillable = ['productid', 'nonclubdiscountdifference', 'lastmodifieddate', 'lastmodifiedby', 'nonclubdiscountdifferencetype'];
	/**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    public function productinfowithtype()
    {
        return $this->belongsTo('App\ProductInfoWithType', 'productid', 'productid');
    }
}
