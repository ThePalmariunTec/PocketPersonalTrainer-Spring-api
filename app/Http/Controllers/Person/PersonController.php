<?php


namespace App\Http\Controllers\Person;


use App\DTO\PersonDTO;
use App\Http\Controllers\Controller;
use App\Service\Interfaces\PersonServiceInterface;
use App\Service\PersonService;
use Illuminate\Http\Request;

class PersonController extends Controller
{
    private $service;

    public function __construct(PersonService $service)
    {
        $this->service = $service;
    }

    public function findAll()
    {
        return response()->json($this->service->findAll());
    }

    public function insert(Request $request)
    {
        $dto = new PersonDTO();
        $dto->name = $request->name;
        $dto->rg = $request->rg;
        $dto->address = $request->address;
        $dto->birthday = $request->birthday;
        $dto->phone = $request->phone;
        $dto->cpf = $request->cpf;

        return $this->service->insert($dto);

    }
}