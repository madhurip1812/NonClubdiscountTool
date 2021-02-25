<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PagemasterModel extends Model
{
    protected $connection = 'mysql';
    public $table = 'pagemaster';
    protected $primaryKey = 'page_id';
    public $timestamps = false;
}
