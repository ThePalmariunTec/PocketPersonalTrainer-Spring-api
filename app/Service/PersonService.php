<?php


namespace App\Service;




use App\DTO\PersonDTO;
use App\Repository\Interfaces\PersonRepositoryInterface;
use App\Service\Interfaces\PersonServiceInterface;

class PersonService implements PersonServiceInterface
{

    private $repository;

    public function __construct(PersonRepositoryInterface $repository)
    {
        $this->repository = $repository;
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
        $objs =  $this->repository->findAllPersonsWithAddress();
        $dados = array();
        foreach ($objs as $obj){
            $dto = new PersonDTO();
            $dto->id = $obj->getId();
            $dto->name = $obj->getName();

            array_push($dados, $dto);
        }

        return $dados;
    }

    function search($parameters)
    {
        // TODO: Implement search() method.
    }
}