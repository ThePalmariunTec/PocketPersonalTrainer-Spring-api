<?php


namespace App\Service;


use App\DTO\TrainDTO;
use App\Model\Train;
use App\Repository\Interfaces\TrainRepositoryInterface;
use App\Service\Interfaces\TrainServiceInterface;
use Doctrine\ORM\Query\QueryException;
use Illuminate\Http\Response;

class TrainService implements TrainServiceInterface
{
    private $repository;

    public function __construct(TrainRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    function insert($dto)
    {
        try {
            $train = new Train();
            $this->repository->insert($this->trainDTOtoEntity($dto, $train));
        } catch (QueryException $e) {

            return response()->json('Not ok', Response::HTTP_CREATED);
        }

        return response()->json('ok', Response::HTTP_CREATED);
    }

    function update($dto)
    {
        try {
            $train = new Train();
            $this->repository->update($this->trainDTOtoEntity($dto, $train));
        } catch (QueryException $e) {

            return response()->json('Not ok', Response::HTTP_CREATED);
        }

        return response()->json('ok', Response::HTTP_CREATED);
    }

    function findById($id)
    {
        return $this->repository->findById($id);
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

    function search($dto)
    {
        $train = new Train();
        $this->repository->findBy($this->trainDTOtoEntity($dto, $train));
    }

    function delete($id)
    {
        try {
            $this->repository->delete($id);
        } catch (QueryException $e) {

            return response()->json('Not ok', Response::HTTP_CREATED);
        }

        return response()->json('ok', Response::HTTP_CREATED);
    }

    private function trainDTOtoEntity(TrainDTO $dto, Train $entity): Train
    {
        $entity->setId($dto->id);
        $entity->setName($dto->name);
        $entity->setDescription($dto->desciption);


        return $entity;
    }
}