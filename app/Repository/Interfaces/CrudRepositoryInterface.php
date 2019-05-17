<?php


namespace App\Repository\Interfaces;


interface CrudRepositoryInterface
{
    function insert($entity);
    function update($id, $entity);
    function delete($id);
    function findById($id);
    function findAll();
}