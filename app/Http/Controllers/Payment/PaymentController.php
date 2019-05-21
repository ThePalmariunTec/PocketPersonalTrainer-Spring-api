<?php


namespace App\Http\Controllers\Payment;


use App\DTO\PaymentDTO;
use App\Http\Controllers\Controller;
use App\Service\PaymentService;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    private $service;

    public function __construct(PaymentService $service)
    {
        $this->service = $service;
    }

    public function findAll()
    {
        return response()->json($this->service->findAll());
    }

    public function insert(Request $request)
    {
        $dto = new PaymentDTO();
        $dto->id = $request->id;
        $dto->value = $request->value;
        $dto->pay = $request->pay;

        return $this->service->insert($dto);

    }

    public function update(Request $request)
    {
        $dto = new PaymentDTO();
        $dto->id = $request->id;
        $dto->value = $request->value;
        $dto->pay = $request->pay;

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