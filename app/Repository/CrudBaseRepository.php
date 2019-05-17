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
        $qb = $this->entityManager->createQueryBuilder();

        $qb->update($this->entityName)
            ->set($entity)
            ->where($id);

        return $qb->getQuery()->getResult();
    }

    function findById($id)
    {
        $qb = $this->entityManager->createQueryBuilder();

        $qb->select('c')
            ->from($this->entityName, 'c')
            ->where($id);

        return $qb->getQuery()->getResult();
    }

    function findAll()
    {
        $qb = $this->entityManager->createQueryBuilder();

        $qb->select('c')
            ->from($this->entityName, 'c');

        return $qb->getQuery()->getResult();
    }


    function delete($id)
    {
        $qb = $this->entityManager->createQueryBuilder();

        $qb->delete()
            ->from($this->entityName, 'c')
            ->where($id);

        return $qb->getQuery()->getResult();
    }
}