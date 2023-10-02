<?php

namespace App\Services\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService implements UserServiceContract
{
    /**
     * @var UserRepositoryContract $userRepository
     */
    protected UserRepositoryContract $userRepository;

    /**
     * UserRepository Contructor
     *
     * @param UserRepositoryContract $userRepositoryContract
     */
    public function __construct(UserRepositoryContract $userRepositoryContract)
    {
        $this->userRepository = $userRepositoryContract;
    }

    /**
     * @return string
     */
    public function model(): string
    {
        return $this->userRepository->model();
    }

    /**
     * @return User
     * @param int $id
     */
    public function find(int $id): User
    {
        return $this->userRepository->find($id);
    }

    /**
     * Create user
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function create(Request $request): JsonResponse
    {
        $validator = $this->validateMakeUser(UserRegisterStatusEnum::REGISTER, $request);

        if ($validator->fails())
            return response()->json($validator->errors(), Response::HTTP_INTERNAL_SERVER_ERROR);

        $array = $request->all();

        $array['ip'] = $request->ip();

        $array['sexo'] = strtoupper($array['sexo']);
        $array['password'] = Hash::make($array['senha']);
        $array['tag'] = $this->createTag($request);

        $account_exists = $this->userRepository->findByEmail($array['email']);

        if ($account_exists)
            return $this->jsonResponse(Response::HTTP_CONFLICT, 'Email ja cadastrado em nossa base de dados.');

        $createUser = $this->userRepository->createUser($array);

        if (!$createUser) {
            return $this->jsonResponse(Response::HTTP_BAD_REQUEST, 'Ocorreu um erro no cadastro de usuario');
        }

        return  $this->jsonResponse(Response::HTTP_OK, 'Cadastro realizado com sucesso!.');
    }

        /**
     * returns jsonresponse along with code and error message
     *
     * @param int $code
     * @param string $message
     * @return JsonResponse
     */
    private function jsonResponse(int $code, string $message): JsonResponse
    {
        return response()->json([
            'status' => intval($code),
            'message' => $message,
        ]);
    }


}
