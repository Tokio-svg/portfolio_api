<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Moloquent;

class Contact extends Moloquent
{
    use HasFactory;

    protected $connection = 'mongodb';
    protected $guarded = array('id');
}
