<?php


namespace App\Service;


use App\DTO\ClientDTO;
use App\DTO\PersonDTO;
use App\Model\Address;
use App\Model\Client;
use App\Model\Person;
use App\Model\User;
use App\Repository\ClientRepository;
use App\Repository\PersonRepository;
use App\Repository\UserRepository;
use App\Service\Interfaces\ClientServiceInterface;
use Carbon\Carbon;
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
            $client = $this->dtoToClient($dto);
            $this->repository->insert($client);
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
        $objs = $this->repository->findAllClientsWithPersonAndUser();
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
        return $this->repository->findBy($dto);
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

    private function dtoToClient($dto): Client{
        $client = new Client();
        $person = new Person();
        $address = new Address();
        $user = new User();

        $address->setName($dto->person->address->name);
        $address->setCity($dto->person->address->city);
        $address->setUf($dto->person->address->uf);
        $address->setZipcode($dto->person->address->zipcode);

        $person->setName($dto->person->name);
        $person->setRg($dto->person->rg);
        $person->setCpf($dto->person->cpf);
        $person->setPhone($dto->person->phone);
        $person->setBirthDay(Carbon::parse($dto->person->birthday));
        $person->setWeight($dto->person->weight);
        $person->setHeight($dto->person->height);
        $person->setAddress($address);
        $user->setUserName($dto->user->userName);
        $user->setEmail($dto->user->email);
        $user->setPassword($dto->user->password);
        $client->setPerson($person);
        $client->setUser($user);

        return $client;
    }
}