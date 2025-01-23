<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class book extends Model
{
    //Craete a model assosiate with database table
    protected $fillable = [
    "name".
    "author".
    "edition".
    "description".
    "price".
    "created_at"
    ];
}
