<?php


namespace App\Service;


use App\DTO\GymDTO;
use App\Model\Address;
use App\Model\Gym;
use App\Model\User;
use App\Repository\AddressRepository;
use App\Repository\GymRepository;
use App\Repository\UserRepository;
use App\Service\Interfaces\BaseServiceInterface;
use Doctrine\ORM\Query\QueryException;
use Illuminate\Http\Response;

class GymService implements BaseServiceInterface
{
    private $addressRepository;
    private $repository;
    private $userRepository;

    public function __construct(AddressRepository $addressRepository, GymRepository $repository, UserRepository $userRepository)
    {
        $this->repository = $repository;
        $this->userRepository = $userRepository;
        $this->addressRepository = $addressRepository;
    }

    function insert($dto)
    {
        try {
            $gym = new Gym();
            $this->repository->insert($this->gymDTOtoEntity($dto, $gym));
        } catch (QueryException $e) {
            return response()->json('Not ok', Response::HTTP_CREATED);
        }
        return response()->json('ok', Response::HTTP_CREATED);
    }

    function update($dto)
    {
        try {
            $gym = new Gym();
            $this->repository->update($this->gymDTOtoEntity($dto, $gym));
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
        $objs = $this->repository->findAllGymWithUser();
        $dados = array();
        foreach ($objs as $obj){
            $dto = new GymDTO();
            $dto->id = $obj->getId();
            $dto->address = $obj->getAddress();
            $dto->user = $obj->getUser();

            array_push($dados, $dto);
        }

        return $dados;
    }

    function search($dto)
    {
        $gym = new Gym();
        return $this->repository->findBy($this->gymDTOtoEntity($dto,$gym));
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

    private function gymDTOtoEntity(GymDTO $dto, Gym $entity): Gym
    {
        $entity->setId($dto->id);
        $entity->setName($dto->name);
        $entity->setPhone($dto->phone);
        $addresses = array();
        foreach ($dto->address as $address) {
            $objAdress = $this->addressRepository->findById($address->id);
            array_push($addresses, $objAdress);
        }

        $entity->setAddress($addresses);
        $user = array();
        foreach ($dto->$user as $user){
            $objUser = $this->userRepository->findById($user->id);
            array_push($user, $objUser);
        }
        $entity->setUser($user);

        return $entity;
    }

    private function dtoToGym($dto): Gym
    {
        $gym = new Gym();
        $address = new Address();
        $user = new User();

        $address->setName($dto->person->address->name);
        $address->setCity($dto->person->address->city);
        $address->setUf($dto->person->address->uf);
        $address->setZipcode($dto->person->address->zipcode);


        $user->setUserName($dto->user->userName);
        $user->setEmail($dto->user->email);
        $user->setPassword($dto->user->password);
        $gym->setAddress($address);
        $gym->setUser($user);


        return $gym;
    }
}