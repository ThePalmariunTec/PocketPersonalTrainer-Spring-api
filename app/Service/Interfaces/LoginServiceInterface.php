<?php


namespace App\Service\Interfaces;


use App\DTO\UserDTO;

interface LoginServiceInterface
{
    public function login(UserDTO $userDTO);
}