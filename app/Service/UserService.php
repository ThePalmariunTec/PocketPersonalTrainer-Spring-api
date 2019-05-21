<?php


namespace App\Service;


use App\DTO\UserDTO;
use App\Model\User;
use App\Repository\ClientRepository;
use App\Repository\EmployeeRepository;
use App\Repository\GymRepository;
use App\Repository\RolesRepository;
use App\Repository\UserRepository;
use App\Service\Interfaces\BaseServiceInterface;
use Doctrine\ORM\Query\QueryException;
use Illuminate\Http\Response;

class UserService implements BaseServiceInterface
{
    private $repository;
    private $clientRepository;
    private $employeeRepository;
    private $gymRepository;
    private $rolesRepository;


    public function __construct(UserRepository $userRepository, ClientRepository $clientRepository,
                                EmployeeRepository $employeeRepository, GymRepository $gymRepository,
                                RolesRepository $rolesRepository)
    {
        $this->repository = $userRepository;
        $this->clientRepository = $clientRepository;
        $this->employeeRepository = $employeeRepository;
        $this->gymRepository = $gymRepository;
        $this->rolesRepository = $rolesRepository;
    }

    function insert($dto)
    {
        try {
            $user = new User();
            $this->repository->insert($this->userDTOtoEntity($dto, $user));
        } catch (QueryException $e) {
            return response()->json('Not ok', Response::HTTP_CREATED);
        }
        return response()->json('ok', Response::HTTP_CREATED);
    }

    function update($dto)
    {
        try {
            $user = new User();
            $this->repository->update($this->userDTOtoEntity($dto, $user));
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
        $obj = $this->repository->findAll();
        $data = array();

        foreach ($obj as $objs){
            $dto = new UserDTO();

            $dto->id = $objs->getId();
            $dto->userName = $objs->getUserName();
            $dto->email = $objs->getEmail();
            $dto->senha = $objs->getSenha();
            $dto->client = $objs->getClient();
            $dto->employee = $objs->getEmployee();
            $dto->gym = $objs->getGym();

            array_push($dados, $dto);
        }

        return $data;
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

    function search($dto)
    {
        // TODO: Implement search() method.
    }

    private function userDTOtoEntity(UserDTO $dto, User $entity): User
    {
        $entity->setId($dto->id);
        $entity->setEmail($dto->email);
        $entity->setPassword($dto->senha);
        $entity->setUserName($dto->userName);
        $roles = array();
        foreach ($dto->roles as $roles){
            $objRoles = $this->rolesRepository->findById($roles->id);
            array_push($roles, $objRoles);
        }
        $entity->setRoles($roles);
        $client = array();
        foreach ($dto->client as $clients){
            $objClients = $this->clientRepository->findById($clients->id);
            array_push($client, $objClients);
        }
        $entity->setClient($client);
        $employee = array();
        foreach ($dto->employee as $employees){
            $objEmployee = $this->employeeRepository->findById($employees->id);
            array_push($employee, $objEmployee);
        }
        $entity->setEmployee($employee);
        $gym = array();
        foreach ($dto->gym as $gyms){
            $objGym = $this->gymRepository->findById($gyms->id);
            array_push($gym, $objGym);
        }
        $entity->setClient($gym);

        return $entity;
    }
}