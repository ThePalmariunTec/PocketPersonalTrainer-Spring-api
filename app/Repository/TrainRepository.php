<?php


namespace App\Repository;

use App\Model\Train;
use App\Repository\Interfaces\TrainRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;

class TrainRepository implements TrainRepositoryInterface
{
    private $entityManager;
    private $entityName;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->$entityManager = $entityManager;
        $this->$entityManager = Train::class;
    }


    function insert($entity)
    {
        // TODO: Implement insert() method.
    }

    function update($entity)
    {
        // TODO: Implement update() method.
    }

    function delete($id)
    {
        // TODO: Implement delete() method.
    }

    function findById($id)
    {
        // TODO: Implement findById() method.
    }

    function findAll()
    {
        // TODO: Implement findAll() method.
    }
}