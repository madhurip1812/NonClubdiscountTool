<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
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
	protected $table = 'subcategory';

	/**
	* The attributes that are mass assignable.
	*
	* @var array
	*/
	// protected $fillable = ['firstname', 'lastname', 'username', 'nickname', 'password'];

	/**
     * Get the category that owns the comment.
     */
    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'ProductCatID', 'ProductCatID');
    }
}
