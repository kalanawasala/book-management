<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class book extends Model
{
    //To pass both crated_at/ Updated_at rule in laravel 
    public $timestamps = false;
    //Craete a model assosiate with database table
    protected $fillable = [
    "name",
    "author",
    "edition",
    "description",
    "price",
    "created_at"
    ];

   
}
