<?php


namespace App\Service;


use App\DTO\UserDTO;
use App\Repository\Interfaces\UserRepositoryInterface;
use App\Service\Interfaces\LoginServiceInterface;
use Illuminate\Http\Response;

class LoginService implements LoginServiceInterface
{

    private $repository;

    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function login(UserDTO $userDTO)
    {
        $login = $this->repository->login($userDTO->userName, $userDTO->password);

        if($login) {
            return response()->json('Login Sucesso', Response::HTTP_OK);
        }

        return response()->json('Usuario ou senha invalido', Response::HTTP_UNAUTHORIZED);
    }
}