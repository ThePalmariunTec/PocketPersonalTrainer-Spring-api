<?php


namespace App\Http\Controllers\Client;


use App\DTO\ClientDTO;
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
        $dto->person = $request->person;
        $dto->user = $request->user;

        return $this->service->insert($dto);

    }

    public function update(Request $request)
    {
        $dto = new ClientDTO();
        $dto->person = $request->person;
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