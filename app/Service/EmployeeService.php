<?php


namespace App\Service\Interfaces;


use App\DTO\EmployeeDTO;
use App\Model\Employee;
use App\Repository\EmployeeRepository;
use App\Repository\PersonRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\Query\QueryException;
use Illuminate\Http\Response;

class EmployeeService  implements BaseServiceInterface
{
    private $personRepository;
    private $userRepository;
    private $repository;

    public function __construct(PersonRepository $personRepository,
                                UserRepository $userRepository, EmployeeRepository $employeeRepository)
    {
        $this->personRepository = $personRepository;
        $this->userRepository = $userRepository;
        $this->repository = $employeeRepository;
    }

    function insert($dto)
    {
        try {
            $employee = new Employee();
            $this->repository->insert($this->employeeDTOtoEntity($dto, $employee));
        } catch (QueryException $e) {
            return response()->json('Not ok', Response::HTTP_CREATED);
        }
        return response()->json('ok', Response::HTTP_CREATED);
    }

    function update($dto)
    {
        try {
            $employee = new Employee();
            $this->repository->update($this->employeeDTOtoEntity($dto, $employee));
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
        $objs = $this->repository->findAllEmployeeWithPersonAndUser();
        $dados = array();
        foreach ($objs as $obj){
            $dto = new EmployeeDTO();
            $dto->id = $obj->getId();
            $dto->person = $obj->getPerson();
            $dto->user = $obj->getUser();

            array_push($dados, $dto);
        }

        return $dados;
    }

    function search($dto)
    {
        $employee = new Employee();
        return $this->repository->findBy($this->employeeDTOtoEntity($dto,$employee));
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
    private function employeeDTOtoEntity(EmployeeDTO $dto, Employee $entity): Employee{

        $entity->setId($dto->id);
        $entity->setDocument($dto->document);
        $entity->setJob($dto->job);
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

}