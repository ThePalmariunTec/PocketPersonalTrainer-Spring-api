<?php


namespace App\Repository;

use App\Repository\Interfaces\CrudRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;

class CrudBaseRepository implements CrudRepositoryInterface
{
    public $entityManager;
    public $entityName;


    public function __construct(EntityManagerInterface $entityManager, string $entityName)
{
    $this->entityManager = $entityManager;
    $this->entityName = $entityName;
}

    function insert($entity)
    {
        // TODO: Implement insert() method.
    }

    function update($id, $entity)
    {
        // TODO: Implement update() method.
    }

    function findById($id)
    {
        // TODO: Implement findById() method.
    }

    function findAll()
    {
        $qb = $this->entityManager->createQueryBuilder();

        $qb->select('c')
            ->from($this->entityName, 'c');

        return $qb->getQuery()->getResult();
    }

    function search($parameters)
    {
        // TODO: Implement search() method.
    }
}