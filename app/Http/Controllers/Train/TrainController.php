<?php


namespace App\Http\Controllers\Train;


use App\DTO\TrainDTO;
use App\Http\Controllers\Controller;
use App\Service\TrainService;
use Illuminate\Http\Request;

class TrainController extends Controller
{
    private $service;

    public function __construct(TrainService $service)
    {
        $this->service = $service;
    }

    public function findAll()
    {
        return response()->json($this->service->findAll());
    }

    public function insert(Request $request)
    {
        $dto = new TrainDTO();
        $dto->name = $request->name;
        $dto->desciption = $request->description;

        return $this->service->insert($dto);

    }

    public function update(Request $request)
    {
        $dto = new TrainDTO();
        $dto->id = $request->id;
        $dto->name = $request->name;
        $dto->desciption = $request->description;

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