<?php

namespace App\Services\User\Contract;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

interface UserServiceContract
{
    public function find(int $id): User;
    public function list(): mixed;
    public function createUser(array $array): User;
    public function updateUser(int $userId,array $array): User;
    public function deleteUser(int $userId): mixed;
}
