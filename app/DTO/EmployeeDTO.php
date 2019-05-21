<?php


namespace App\DTO;


use Doctrine\Common\Collections\ArrayCollection;

class EmployeeDTO
{
    public $id;

    public $document;

    public $job;

    public $person;

    public $user;


    public function __construct()
    {
        $this->person = new ArrayCollection();
        $this->user = new ArrayCollection();
    }
}