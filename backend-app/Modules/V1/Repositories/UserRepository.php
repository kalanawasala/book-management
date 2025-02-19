<?php

namespace Modules\V1\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Illuminate\Support\Facades\DB;
use Modules\V1\Entities\User;

class UserRepository extends BaseRepository
{

    function model()
    {
        return "Modules\\V1\\Entities\\User";
    }

    public function __construct() {}
}
