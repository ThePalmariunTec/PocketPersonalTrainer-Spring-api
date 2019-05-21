<?php


namespace App\Repository\Interfaces;


interface CrudRepositoryInterface
{
    function insert($entity);
    function update($entity);
    function delete($id);
    function findById($id);
    function findAll();
    function  findBy($entity);
}