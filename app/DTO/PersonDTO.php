<?php


namespace App\DTO;


use Doctrine\Common\Collections\ArrayCollection;

class PersonDTO
{
    public $id;
    public $name;
    public $address;
    public $phone;
    public $cpf;
    public $rg;
    public $birthday;
    public $height;
    public $weight;

    public function __construct()
    {
        $this->address = new ArrayCollection();
    }
}