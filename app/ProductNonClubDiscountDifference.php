<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductNonClubDiscountDifference extends Model
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
	protected $table = 'productnonclubdiscount.productnonclubdiscountdifference';

	/**
     * Get the category that owns the condition.
     */

    /**
	* The attributes that are mass assignable.
	*
	* @var array
	*/

	protected $fillable = ['productid', 'nonclubdiscountdifference', 'lastmodifieddate', 'lastmodifiedby', 'nonclubdiscountdifferencetype','ismanual','nonclubdiscount'];
	/**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */

	/**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'productid';
    public $timestamps = false;

    /**
     * Get the product that owns the condition.
     */
    public function product()
    {
        return $this->belongsTo('App\ProductInfoWithTypeMRPChange', 'productid', 'productid');
    }
}
