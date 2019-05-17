<?php


namespace App\Repository;

use App\Model\Train;
use App\Repository\Interfaces\TrainRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;

class TrainRepository  extends CrudBaseRepository implements TrainRepositoryInterface
{
    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct($entityManager, Train::class);
    }


}