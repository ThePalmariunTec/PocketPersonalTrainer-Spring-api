<?php


namespace App\DTO;


use Doctrine\Common\Collections\ArrayCollection;

class ClientDTO
{
    public $id;

    public $person;

    public $user;

    public function __construct()
    {
        $this->person = new ArrayCollection();
        $this->user = new ArrayCollection();
    }
}