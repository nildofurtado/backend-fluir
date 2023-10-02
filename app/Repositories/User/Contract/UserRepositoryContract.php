<?php

namespace App\Repositories\User\Contract;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

interface UserRepositoryContract
{
    public function find(int $id): User;
    public function list(): mixed;
    public function createUser(array $array): User;
    public function updateUser(int $userId,array $array): User;
    public function deleteUser(int $userId): mixed;
}
