<?php


namespace App\Service;


use App\DTO\ClientDTO;
use App\Model\Client;
use App\Repository\ClientRepository;
use App\Repository\PersonRepository;
use App\Repository\UserRepository;
use App\Service\Interfaces\ClientServiceInterface;
use Doctrine\ORM\Query\QueryException;
use Illuminate\Http\Response;

class ClientService implements ClientServiceInterface
{
    private $personRepository;
    private $userRepository;
    private $repository;

    public function __construct(PersonRepository $personRepository,
                                UserRepository $userRepository, ClientRepository $clientRepository)
    {
        $this->personRepository = $personRepository;
        $this->userRepository = $userRepository;
        $this->repository = $clientRepository;
    }


    function insert($dto)
    {
        try {
            $client = new Client();
            $this->repository->insert($this->clientDTOtoEntity($dto, $client));
        } catch (QueryException $e) {
            return response()->json('Not ok', Response::HTTP_CREATED);
        }
        return response()->json('ok', Response::HTTP_CREATED);
    }

    function update($dto)
    {
        try {
            $client = new Client();
            $this->repository->update($this->clientDTOtoEntity($dto, $client));
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
        $objs = $this->repository->findAll();
        $dados = array();
        foreach ($objs as $obj){
            $dto = new ClientDTO();
            $dto->id = $obj->getId();
            $dto->person = $obj->getPerson();
            $dto->user = $obj->getUser();
            array_push($dados, $dto);
        }

        return $dados;
    }

    function search($dto)
    {
        $client = new Client();
        return $this->repository->findBy($this->clientDTOtoEntity($dto,$client));
    }

    private function clientDTOtoEntity(ClientDTO $dto, Client $entity):Client{

        $entity->setId($dto->id);
        $person = array();
        foreach ($dto->person as $person) {
            $objPerson = $this->personRepository->findById($person->id);
            array_push($person, $objPerson);
        }
        $entity->setPerson($person);
        $user = array();
        foreach ($dto->$user as $user){
            $objUser = $this->userRepository->findById($user->id);
            array_push($user, $objUser);
        }
        $entity->setUser($user);

        return $entity;
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
}