<?php

namespace Modules\V1\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Modules\V1\Entities\User;

class UserRepository extends BaseRepository
{

    function model()
    {
        return "Modules\\V1\\Entities\\User";
    }

    public function __construct() {}

    public function createUser($request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),

        ]);
        return $user;
    }
}
