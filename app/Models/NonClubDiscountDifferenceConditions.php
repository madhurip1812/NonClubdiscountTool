<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NonClubDiscountDifferenceConditions extends Model
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
	protected $table = 'productnonclubdiscount.nonclubdiscountdifferenceconditions';
	protected $casts = [
        'avgvalueforlow' => 'int',
        'discountdifferentforlow' => 'int',
        'discountdifferenceformid' => 'int',
        'avgvalueforhigh' => 'int',
        'discountdifferenceforhigh' => 'int',
    ];
	/**
     * Get the category that owns the condition.
     */
    public function category()
    {
        return $this->belongsTo('App\Category', 'categoryid', 'productcatid');
    }
	/**
     * Get the category that owns the condition.
     */
    public function subcategory()
    {
        return $this->belongsTo('App\SubCategory', 'subcategoryid', 'subcatid');
    }

    /**
	* The attributes that are mass assignable.
	*
	* @var array
	*/
	protected $fillable = ["id","categoryid","subcategoryid","typeid","typename","avgvalueforlow","discountdifferentforlow","discountdifferenceformid","avgvalueforhigh","discountdifferenceforhigh","avgsale","createddate","createdby","lastmodifieddate","lastmodifiedby","isactive","ruleid"];
	/**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
}
