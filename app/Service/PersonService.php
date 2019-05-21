<?php


namespace App\Service;




use App\DTO\PersonDTO;
use App\Model\Person;
use App\Repository\AddressRepository;
use App\Repository\PersonRepository;
use App\Service\Interfaces\PersonServiceInterface;
use Carbon\Carbon;
use Doctrine\ORM\Query\QueryException;
use Illuminate\Http\Response;

class PersonService implements PersonServiceInterface
{

    private $repository;
    private $addressRepository;

    public function __construct(PersonRepository $repository, AddressRepository $addressRepository)
    {
        $this->repository = $repository;
        $this->addressRepository = $addressRepository;
    }

    function insert($dto)
    {

        try {
            $person = new Person();
            $this->repository->insert($this->personDTOtoPersonEntity($dto, $person));
        } catch (QueryException $e) {
            return response()->json('Not ok', Response::HTTP_CREATED);
        }
        return response()->json('ok', Response::HTTP_CREATED);
    }

    function update($dto)
    {
        try {
            $person = new Person();
            $this->repository->update($this->personDTOtoPersonEntity($dto, $person));
        } catch (QueryException $e) {
            return response()->json('Not ok', Response::HTTP_CREATED);
        }
        return response()->json('ok', Response::HTTP_CREATED);
    }

    function findById($id)
    {
        $obj =  $this->repository->findById($id);

        $dto = new PersonDTO();

        $dto->id = $obj->getId();
        $dto->name = $obj->getName();
        $dto->address = $obj->getAddress();
        $dto->cpf = $obj->getCpf();
        $dto->rg = $obj->getRg();
        $dto->phone = $obj->getPhone();
        $dto->birthday = $obj->getBirthday();

        return $dto;
    }

    function findAll()
    {
        $objs =  $this->repository->findAllPersonsWithAddress();
        $dados = array();

        foreach ($objs as $obj){
            $dto = new PersonDTO();
            $dto->id = $obj->getId();
            $dto->name = $obj->getName();
            $dto->address = $obj->getAddress();
            $dto->cpf = $obj->getCpf();
            $dto->rg = $obj->getRg();
            $dto->phone = $obj->getPhone();
            $dto->birthday = $obj->getBirthday();
            $dto->height = $obj->getHeight();
            $dto->weight = $obj->getWeight();

            array_push($dados, $dto);
        }

        return $dados;
    }

    function search($dto)
    {
        $person = new Person();
        return $this->repository->findBy($this->personDTOtoPersonEntity($dto,$person));
    }

    private function personDTOtoPersonEntity(PersonDTO $dto, Person $entity) : Person
    {
        $entity->setCpf($dto->cpf);
        $entity->setName($dto->name);
        $entity->setPhone($dto->phone);
        $entity->setRg($dto->rg);
        $entity->setBirthDay(Carbon::parse($dto->birthday));
        $entity->setHeigth($dto->height);
        $entity->setWeight($dto->weight);
        $addresses = array();
        foreach ($dto->address as $address) {
            $objAdress = $this->addressRepository->findById($address->id);
            array_push($addresses, $objAdress);
        }

        $entity->setAddress($addresses);
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