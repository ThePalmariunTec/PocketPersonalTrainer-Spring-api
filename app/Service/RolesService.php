<?php


namespace App\Service;


use App\Model\Roles;
use App\Repository\RolesRepository;
use App\Repository\UserRepository;
use App\Service\Interfaces\BaseServiceInterface;
use Doctrine\ORM\Query\QueryException;
use Illuminate\Http\Response;

class RolesService implements BaseServiceInterface
{

    private $repositoy;
    private $userRepository;

    public function __construct(RolesRepository $rolesRepository, UserRepository $userRepository)
    {
        $this->repositoy = $rolesRepository;
        $this->userRepository = $userRepository;
    }

    function insert($dto)
    {
        try {
            $roles = new Roles();
            $this->repositoy->insert($this->rolesDTOtoEntity($dto,$roles));
        } catch (QueryException $e) {

            return response()->json('Not ok', Response::HTTP_CREATED);
        }

        return response()->json('ok', Response::HTTP_CREATED);
    }

    function update($dto)
    {
        try {
            $roles = new Roles();
            $this->repositoy->update($this->rolesDTOtoEntity($dto,$roles));
        } catch (QueryException $e) {

            return response()->json('Not ok', Response::HTTP_CREATED);
        }

        return response()->json('ok', Response::HTTP_CREATED);
    }

    function findById($id)
    {
        return $this->repositoy->findById($id);
    }

    function findAll()
    {
        $objs = $this->repository->findAll();
        $dados = array();
        foreach ($objs as $obj){
            $dto = new RolesDTO();
            $dto->id = $obj->getId();
            $dto->rating = $obj->getRating();
            $dto->description = $obj->getDescription();
            $dto->user = $obj->getUser();

            array_push($dados, $dto);
        }

        return $dados;
    }

    function delete($id)
    {

        try {
            $this->repositoy->delete($id);
        } catch (QueryException $e) {

            return response()->json('Not ok', Response::HTTP_CREATED);
        }

        return response()->json('ok', Response::HTTP_CREATED);
    }

    function search($dto)
    {
        $roles = new Roles();
        return $this->repositoy->findBy($this->rolesDTOtoEntity($dto, $roles));
    }

    private function rolesDTOtoEntity($dto, Roles $entity): Roles
    {
        $entity->setId($dto->id);
        $entity->setRating($dto->rating);
        $entity->setDescription($dto->description);
        $user = array();
        foreach ($dto->$user as $user){
            $objUser = $this->userRepository->findById($user->id);
            array_push($user, $objUser);
        }
        $entity->setUser($user);

        return $entity;
    }
}