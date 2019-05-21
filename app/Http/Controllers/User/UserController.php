<?php


namespace App\Http\Controllers\User;


use App\DTO\UserDTO;
use App\Http\Controllers\Controller;
use App\Service\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $service;

    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    public function findAll()
    {
        return response()->json($this->service->findAll());
    }

    public function insert(Request $request)
    {
        $dto = new UserDTO();
        $dto->email = $request->email;
        $dto->password = $request->password;
        $dto->userName = $request->userName;
        $dto->roles = $request->roles;
        $dto->client = $request->client;
        $dto->employee = $request->employee;
        $dto->gym = $request->gym;

        return $this->service->insert($dto);

    }

    public function update(Request $request)
    {
        $dto = new UserDTO();
        $dto->email = $request->email;
        $dto->password = $request->password;
        $dto->userName = $request->userName;
        $dto->roles = $request->roles;
        $dto->client = $request->client;
        $dto->employee = $request->employee;
        $dto->gym = $request->gym;

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

    public function findBy(Request $request){
        $dto = new UserDTO();
        $dto->email = $request->email;
        $dto->password = $request->password;
        $dto->userName = $request->userName;

        return response()->json($this->service->search($dto));
    }
}