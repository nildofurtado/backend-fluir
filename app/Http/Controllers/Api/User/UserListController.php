<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Services\User\Contract\UserServiceContract;
use App\Services\User\UserService;
use Illuminate\Http\Request;

class UserListController extends Controller
{
    /**
     * @var UserService $userService
     */
    private UserService $userService;

    /**
     * UserListController Construct
     *
     * @param UserService $userService
     */
    public function __construct(UserServiceContract $userService)
    {
        $this->userService = $userService;
    }

    public function __invoke(Request $request): mixed
    {
        return $this->userService->find($request->id);
    }


}
