<?php


namespace App\Repository;

use App\Repository\Interfaces\CrudRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Query\QueryException;

class CrudBaseRepository implements CrudRepositoryInterface
{
    private $entityManager;
    private $entityName;


    public function __construct(EntityManagerInterface $entityManager, string $entityName)
    {
        $this->entityManager = $entityManager;
        $this->entityName = $entityName;
    }

    public function getEntityName()
    {
        return $this->entityName;
    }

    public function getEntityManager()
    {
        return $this->entityManager;
    }

    function insert($entity)
    {
        $this->entityManager->beginTransaction();
        try {
            $this->entityManager->persist($entity);
            $this->entityManager->flush();
            $this->entityManager->commit();
        } catch (QueryException $exception) {
            $this->entityManager->rollback();
            throw new QueryException('Falha ao inserir');
        }
    }

    function update($entity)
    {
        $this->entityManager->beginTransaction();
      try {
          $this->entityManager->merge($entity);
          $this->entityManager->flush();
          $this->entityManager->commit();
      } catch (QueryException $exception) {
          $this->entityManager->rollback();
          throw new QueryException('Falha ao atualizar');
      }
    }

    function findById($id)
    {
        return $this->entityManager->find($this->entityName, $id);
    }

    function findAll()
    {
        $qb = $this->entityManager->createQueryBuilder();

        $qb->select('c')
            ->from($this->getEntityName(), 'c');

        return $qb->getQuery()->getResult();
    }


    function delete($id)
    {
        $this->entityManager->beginTransaction();
        try {
            $entity = $this->entityManager->find($this->entityName, $id);
            $this->entityManager->remove($entity);
            $this->entityManager->flush();
            $this->entityManager->commit();
        } catch (QueryException $exception) {
            $this->entityManager->rollback();
            throw new QueryException('Falha ao excluir');
        }

    }
}