<?php


namespace App\Service\Interfaces;


interface BaseServiceInterface
{
    function insert($entity);
    function update($id, $entity);
    function findById($id);
    function findAll();
    function search($parameters);
}