<?php


namespace App\Repository\Interfaces;


interface CrudRepositoryInterface
{
    function insert($entity);
    function update($id, $entity);
    function findById($id);
    function findAll();
    function search($parameters);
}