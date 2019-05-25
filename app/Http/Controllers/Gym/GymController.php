<?php


namespace App\Http\Controllers\Gym;


use App\DTO\AddressDTO;
use App\DTO\GymDTO;
use App\DTO\RolesDTO;
use App\DTO\UserDTO;
use App\Http\Controllers\Controller;
use App\Service\GymService;
use Illuminate\Http\Request;

class GymController extends Controller
{
    private $service;

    public function __construct(GymService $service)
    {
        $this->service = $service;
    }

    public function findAll()
    {
        return response()->json($this->service->findAll());
    }

    public function insert(Request $request)
    {
        $dto = new GymDTO();
        $address = $request->gym['address'];
        $user = $request->gym['user'];
        $roles = $user['roles'];

        $addressDTO = new AddressDTO();
        $addressDTO->name = $address['name'];
        $addressDTO->city = $address['city'];
        $addressDTO->uf = $address['uf'];
        $addressDTO->zipcode = $address['zipcode'];

        $userDTO = new UserDTO();
        $userDTO->email = $user['email'];
        $userDTO->password = $user['password'];
        $userDTO->userName = $user['username'];

        $rolesDTO = new RolesDTO();
        $rolesDTO->role = $roles['role'];


        $dto->address = $address;
        $dto->user = $request->user;

        return $this->service->insert($dto);

    }

    public function update(Request $request)
    {
        $dto = new GymDTO();
        $dto->id = $request->id;
        $dto->name = $request->name;
        $dto->phone = $request->phone;
        $dto->address = $request->address;
        $dto->user = $request->user;

        return $this->service->update($dto);
    }

    public function findById(Request $request){
        $id = $request->id;
        return response()->json($this->service->findById($id));
    }

    public function delete(Request $request){
        $id = $request->id;
        return $this->service->delete($id);
    }


}