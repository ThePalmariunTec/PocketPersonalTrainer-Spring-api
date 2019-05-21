<?php


namespace App\DTO;


use Doctrine\Common\Collections\ArrayCollection;

class UserDTO
{
    public $id;

    public $email;

    public $password;

    public $userName;

    public $employee;

    public $gym;

    public $client;

    public $roles;

    public function __construct()
    {
        $this->client = new ArrayCollection();
        $this->gym = new ArrayCollection();
        $this->employee = new ArrayCollection();
        $this->roles = new ArrayCollection();
    }

}