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
	protected $connection = 'mysql_commonmaster';
	/**
	* The database table used by the model.
	*
	* @var string
	*/
	protected $table = 'category';

	/**
	* The attributes that are mass assignable.
	*
	* @var array
	*/
	// protected $fillable = ['firstname', 'lastname', 'username', 'nickname', 'password'];
	
	/**
     * Get the subcategory for the blog post.
     */
    public function subcategory()
    {
        return $this->hasMany('App\Models\SubCategory');
    }
}
