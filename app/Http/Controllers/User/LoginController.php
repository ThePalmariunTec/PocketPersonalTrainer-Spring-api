<?php


namespace App\Http\Controllers\User;


use App\DTO\UserDTO;
use App\Http\Controllers\Controller;
use App\Service\Interfaces\LoginServiceInterface;
use Illuminate\Http\Request;


class LoginController extends Controller
{
    private $service;

    public function __construct(LoginServiceInterface $service)
    {
        $this->service = $service;
    }


    public function login(Request $request)
    {
        $dto = new UserDTO();
        $dto = $this->requestMapper($dto,$request->all());
        return $this->service->login($dto);
    }


    private function requestMapper(UserDTO $dto, array $request)
    {
        $dto->userName = $request['username'];
        $dto->password = $request['password'];

        return $dto;
    }
}