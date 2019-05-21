<?php


namespace App\DTO;


use Doctrine\Common\Collections\ArrayCollection;

class RolesDTO
{
    public $id;

    public $rating;

    public $description;

    public $user;

    public function __construct()
    {
        $this->user = new ArrayCollection();
    }

}