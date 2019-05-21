<?php


namespace App\Http\Controllers\Client;


use App\Http\Controllers\Controller;
use App\Service\ClientService;

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
}