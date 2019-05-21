<?php


namespace App\Http\Controllers\ClientPaymentGym;


use App\DTO\ClientPaymentGymDTO;
use App\Http\Controllers\Controller;
use App\Service\ClientPaymentGymService;
use Illuminate\Http\Request;

class ClientPaymentGymController extends Controller
{
    private $service;

    public function __construct(ClientPaymentGymService $service)
    {
        $this->service = $service;
    }

    public function findAll()
    {
        return response()->json($this->service->findAll());
    }

    public function insert(Request $request)
    {
        $dto = new ClientPaymentGymDTO();
        $dto->id = $request->id;
        $dto->client = $request->client;
        $dto->payment = $request->payment;
        $dto->gym = $request->gym;

        return $this->service->insert($dto);

    }

    public function update(Request $request)
    {
        $dto = new ClientPaymentGymDTO();
        $dto->id = $request->id;
        $dto->client = $request->client;
        $dto->payment = $request->payment;
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

}
{

}