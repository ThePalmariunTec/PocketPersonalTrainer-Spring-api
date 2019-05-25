<?php


namespace App\Repository\Interfaces;


interface UserRepositoryInterface extends CrudRepositoryInterface
{
    public function login(string $username, string $password);
}