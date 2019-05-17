<?php


namespace App\Http\Controllers\Person;


use App\Http\Controllers\Controller;
use App\Service\Interfaces\PersonServiceInterface;

class PersonController extends Controller
{
    private $service;

    public function __construct(PersonServiceInterface $service)
    {
        $this->service = $service;
    }

    public function findAll()
    {
        return response()->json($this->service->findAll());
    }
}