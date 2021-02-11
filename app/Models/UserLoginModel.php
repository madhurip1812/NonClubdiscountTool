<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserLoginModel extends Model
{
    protected $connection = 'mysql';
    protected $table = 'users';
    protected $primaryKey = 'id';
    public $timestamps = false;
}
