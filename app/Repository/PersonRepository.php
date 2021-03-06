<?php


namespace App\Repository;


use App\Model\Person;
use App\Repository\Interfaces\PersonRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Query\QueryException;

class PersonRepository implements PersonRepositoryInterface
{
    private $entityManager;
    private $entityName;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->entityName = Person::class;
    }

    public function findAllPersonsWithAddress()
    {
        $qb = $this->entityManager->createQueryBuilder();

        $qb->select('p')
            ->from($this->entityName, 'p');

        return $qb->getQuery()->getResult();
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

    function findById($id)
    {
        return $this->entityManager->find($this->entityName, $id);
    }

    function findAll()
    {
        $qb = $this->entityManager->createQueryBuilder();

        $qb->select('c')
            ->from($this->entityName, 'c');

        return $qb->getQuery()->getResult();
    }

    function findBy($entity)
    {
        return $this->entityManager->find($this->entityName, $entity);
    }
}