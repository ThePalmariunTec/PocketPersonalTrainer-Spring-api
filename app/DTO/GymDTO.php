<?php


namespace App\DTO;


use Doctrine\Common\Collections\ArrayCollection;

class GymDTO
{
    public $id;

    public $name;

    public $phone;

    public $address;

    public $user;

    public function __construct()
    {
        $this->address = new ArrayCollection();
        $this->user = new ArrayCollection();
    }
}