<?php


namespace App\Service\Interfaces;


interface BaseServiceInterface
{
    function insert($dto);
    function update($dto);
    function findById($id);
    function findAll();
    function delete($id);
    function search($dto);
}