<?php


namespace App\Repository;


use App\Model\Person;
use App\Repository\Interfaces\PersonRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;

class PersonRepository extends CrudBaseRepository implements PersonRepositoryInterface
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
     {
         $this->entityManager;
       parent::__construct($entityManager, Person::class);
     }

    public function findAllPersonsWithAddress()
    {
        $qb = $this->entityManager->createQueryBuilder();

        $qb->select('p')
            ->from($this->getEntityName(), 'p');

        return $qb->getQuery()->getResult();
    }
}