<?php


namespace App\Repository;


use App\Model\Gym;
use App\Repository\Interfaces\GymRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Query\QueryException;

class GymRepository implements GymRepositoryInterface
{
    private $entityManager;
    private $entityName;

    public function __construct( EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->entityName = Gym::class;
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

        $qb->select('g')
            ->from($this->entityName, 'g')
            ->innerJoin('g.address', 'a')
            ->innerJoin('g.user', 'u');

        return $qb->getQuery()->getResult();
    }

    function findBy($entity)
    {
        $qb = $this->entityManager->createQueryBuilder();

        $qb->select('c')
            ->from($this->entityName, 'c')
            ->where($entity);

        return $qb->getQuery()->getResult();
    }
    public function findAllGymWithUser(){
        $qb = $this->entityManager->createQueryBuilder();

        $qb->select('g', 'u')
            ->from(Gym::class, 'g', 'u')
            ->innerJoin('c.person', 'p')
            ->innerJoin('c.user', 'u');

        return $qb->getQuery()->getResult();
    }
}