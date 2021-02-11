<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SessionCountryModel extends Model
{
    protected $connection = 'mysql';
    protected $table = 'sessioncountry';
    protected $primaryKey = 'scountryid';
    public $timestamps = false;
    protected $fillable = ['countrycode','sessionstarted','createddate'];
}
