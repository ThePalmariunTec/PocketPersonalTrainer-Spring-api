<?php


namespace App\Service;




use App\DTO\PersonDTO;
use App\Model\Person;
use App\Repository\AddressRepository;
use App\Repository\PersonRepository;
use App\Service\Interfaces\PersonServiceInterface;
use Carbon\Carbon;
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
        $person = new Person();
        $this->repository->insert($this->personDTOtoPersonEntity($dto,$person));
        return response()->json('ok', Response::HTTP_CREATED);
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

    private function personDTOtoPersonEntity(PersonDTO $dto, Person $entity) : Person
    {
        $entity->setCpf($dto->cpf);
        $entity->setName($dto->name);
        $entity->setPhone($dto->phone);
        $entity->setRg($dto->rg);
        $entity->setBirthDay(Carbon::parse($dto->birthday));
        $addresses = array();
        foreach ($dto->address as $address) {
            $objAdress = $this->addressRepository->findById($address->id);
            array_push($addresses, $objAdress);
        }

        $entity->setAddress($addresses);
        return $entity;
    }

}