<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogError extends Model
{
    protected $connection = 'server_pgsql';
    protected $table = 'productnonclubdiscount.logerror';
    protected $primaryKey = 'logerrorid';
    public $timestamps = false;
    protected $fillable = ['logerrorid','username','url','message','clientip','createddate'];

}
