<?php

namespace App\Repositories\User;

use App\Models\User;
use App\Repositories\User\Contract\UserRepositoryContract;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Boolean;

/**
 * Class UserRepository.
 */
class UserRepository implements UserRepositoryContract
{
    /**
     * @var User $model
     */
    protected User $model;

    /**
     * UserRepository Contructor
     *
     * @param User $model
     */
    public function __construct(User $model)
    {
        $this->model = $model;
    }

    /**
     * Get for
     *
     * @param int $id
     *
     * @return User
     *
     */
    public function find(int $id): User
    {
        return $this->model::find($id);
    }

    /**
     * [Description for list]
     *
     * @return User
     *
     */
    public function list(): mixed
    {
        return $this->model::all();
    }

    /**
     * [Description for createUser]
     *
     * @param array $array
     *
     * @return User
     *
     */
    public function createUser(array $array): User
    {
        return $this->model::create($array);
    }

    /**
     * [Description for updateUser]
     *
     * @param int $userId
     * @param array $array
     *
     * @return User
     *
     */
    public function updateUser(int $userId,array $array): User
    {
        $user = $this->model::find($userId);
        $user->update($array);
        return $user;
    }

    /**
     * [Description for deleteUser]
     *
     * @param int $userId
     *
     * @return mixed
     *
     */
    public function deleteUser(int $userId): mixed
    {
        $user = $this->model::delete($userId);
        return $user;
    }
}

