<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CronLog extends Model
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
	protected $table = 'productnonclubdiscount.cronlog';

	/**
     * Get the category that owns the condition.
     */

    /**
	* The attributes that are mass assignable.
	*
	* @var array
	*/

	protected $fillable = ['id', 'ruleid', 'createddate', 'createdby', 'recordcount'];
	/**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
}
