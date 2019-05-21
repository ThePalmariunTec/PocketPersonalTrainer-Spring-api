<?php


namespace App\Http\Controllers\Employee;


use App\DTO\EmployeeDTO;
use App\Http\Controllers\Controller;
use App\Service\Interfaces\EmployeeService;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    private $service;

    public function __construct(EmployeeService $service)
    {
        $this->service = $service;
    }

    public function findAll()
    {
        return response()->json($this->service->findAll());
    }

    public function insert(Request $request)
    {
        $dto = new EmployeeDTO();
        $dto->document = $request->document;
        $dto->job = $request->job;
        $dto->person = $request->person;
        $dto->user = $request->user;

        return $this->service->insert($dto);

    }

    public function update(Request $request)
    {
        $dto = new EmployeeDTO();
        $dto->id = $request->id;
        $dto->document = $request->document;
        $dto->job = $request->job;
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