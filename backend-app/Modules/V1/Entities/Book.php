<?php

namespace Modules\V1\Entities;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = ['id', 'title', 'created_at', 'updated_at'];
    protected $table = 'books';
}
