<?php

namespace Modules\V1\Http\Controllers;

use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Catch_;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Modules\V1\Repositories\UserRepository;
use Illuminate\Contracts\Support\Renderable;
use Modules\V1\Entities\User;

class UsersController extends Controller
{
    protected $userRepository;
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function createUser($request) {}
}
