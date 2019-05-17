<?php


namespace App\Repository\Interfaces;


interface PersonRepositoryInterface extends CrudRepositoryInterface
{
    public function findAllPersonsWithAddress();
}