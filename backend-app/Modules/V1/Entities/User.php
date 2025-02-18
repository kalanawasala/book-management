<?php

namespace Modules\V1\Entities;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'name', 'email', 'password', 'role', 'created_at', 'updated_at'];
    protected $table = 'users';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'role'
    ];

    /**
     * Get the JWT identifier.
     *
     * @return int
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Get the JWT custom claims.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return []; // You can add custom claims here if needed
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
