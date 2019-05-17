<?php


namespace App\Repository;


use App\Model\Person;
use App\Repository\Interfaces\PersonRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;

class PersonRepository extends CrudBaseRepository implements PersonRepositoryInterface
{
    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct($entityManager, Person::class);
    }

    public function findAllPersonsWithAddress()
    {
        $qb = $this->entityManager->createQueryBuilder();

        $qb->select('p')
            ->from($this->entityName, 'p');

        return $qb->getQuery()->getResult();
    }
}