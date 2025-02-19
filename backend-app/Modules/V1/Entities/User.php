<?php

namespace Modules\V1\Entities;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = ['id', 'name', 'email', 'password', 'role', 'created_at', 'updated_at'];
    protected $table = 'users';
}
