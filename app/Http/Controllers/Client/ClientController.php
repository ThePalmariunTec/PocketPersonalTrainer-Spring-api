<?php


namespace App\Http\Controllers\Client;


use App\DTO\AddressDTO;
use App\DTO\ClientDTO;
use App\DTO\PersonDTO;
use App\DTO\RolesDTO;
use App\DTO\UserDTO;
use App\Http\Controllers\Controller;
use App\Service\ClientService;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    private $service;

    public function __construct(ClientService $service)
    {
        $this->service = $service;
    }

    public function findAll()
    {
        return response()->json($this->service->findAll());
    }

    public function insert(Request $request)
    {
        $dto = new ClientDTO();
        $person = $request->client['person'];
        $address = $person['address'];
        $user = $request->client['user'];
        $roles = $user['roles'];

        $addressDTO = new AddressDTO();
        $addressDTO->name = $address['name'];
        $addressDTO->city = $address['city'];
        $addressDTO->uf = $address['uf'];
        $addressDTO->zipcode = $address['zipcode'];

        $personDTO = new PersonDTO();
        $personDTO->name = $person['name'];
        $personDTO->rg = $person['rg'];
        $personDTO->cpf = $person['cpf'];
        $personDTO->phone = $person['phone'];
        $personDTO->height = $person['height'];
        $personDTO->weight = $person['weight'];
        $personDTO->birthday = $person['birthday'];
        $personDTO->address = $addressDTO;

        $userDTO = new UserDTO();
        $userDTO->email = $user['email'];
        $userDTO->password = $user['password'];
        $userDTO->userName = $user['username'];

        $rolesDTO = new RolesDTO();
        $rolesDTO->role = $roles['role'];

        $dto->person = $personDTO;

        $dto->person = $personDTO;
        $dto->user = $userDTO;

        return $this->service->insert($dto);

    }

    public function update(Request $request)
    {

        return $this->service->update($request->all());
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