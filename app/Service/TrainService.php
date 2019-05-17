<?php


namespace App\Service;


use App\DTO\TrainDTO;
use App\Repository\Interfaces\TrainRepositoryInterface;
use App\Service\Interfaces\TrainServiceInterface;

class TrainService implements TrainServiceInterface
{
    private $repository;

    public function __construct(TrainRepositoryInterface $repository)
    {
        $this->$repository = $repository;
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
        $obj = $this->repository.$this->findAll();
        $dados = array();
        foreach ($obj as $objs){
            $dto = new TrainDTO();
            $dto->id = $objs->getId();
            $dto->name = $objs->getName();
            $dto->desciption = $objs->getDescription();

            array_push($dados, $dto);
        }

        return $dados;
    }

    function search($parameters)
    {
        // TODO: Implement search() method.
    }
}