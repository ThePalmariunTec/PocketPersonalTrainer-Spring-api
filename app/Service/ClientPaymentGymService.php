<?php


namespace App\Service;


use App\DTO\ClientPaymentGymDTO;
use App\Model\ClientPaymentGym;
use App\Repository\ClientPaymentGymRepository;
use App\Repository\ClientRepository;
use App\Repository\GymRepository;
use App\Repository\PaymentRepository;
use App\Service\Interfaces\BaseServiceInterface;
use Doctrine\ORM\Query\QueryException;
use Illuminate\Http\Response;

class ClientPaymentGymService implements BaseServiceInterface
{

    private $repository;
    private $clientRepository;
    private $gymRepository;
    private $paymentRepository;


    public function __construct(ClientPaymentGymRepository $repository, ClientRepository $clientRepository,
                                GymRepository $gymRepository, PaymentRepository $paymentRepository)
    {
        $this->repository = $repository;
        $this->clientRepository = $clientRepository;
        $this->gymRepository = $gymRepository;
        $this->paymentRepository = $paymentRepository;
    }

    function insert($dto)
    {
        try {
            $clientPaymentGym = new ClientPaymentGym();
            $this->repository->insert($this->cluentPaymentGymDTOtoEntity($dto, $clientPaymentGym));
        } catch (QueryException $e) {
            return response()->json('Not ok', Response::HTTP_CREATED);
        }
        return response()->json('ok', Response::HTTP_CREATED);
    }

    function update($dto)
    {
        try {
            $clientPaymentGym = new ClientPaymentGym();
            $this->repository->update($this->cluentPaymentGymDTOtoEntity($dto, $clientPaymentGym));
        } catch (QueryException $e) {
            return response()->json('Not ok', Response::HTTP_CREATED);
        }
        return response()->json('ok', Response::HTTP_CREATED);
    }

    function findById($id)
    {
        $obj = $this->repository->findById($id);

        $dto = new ClientPaymentGymDTO();
        $dto->client_id = $obj->getClientId();
        $dto->payment_id = $obj->getPaymentId();
        $dto->gym_id = $obj->getGymId();
        $dto->date_payment = $obj->getDatePayment();

        return $dto;

    }


    function findAll()
    {
        $objs = $this->repository->findAll();
        $dados = array();

        foreach ($objs as $obj){
            $dto = new ClientPaymentGymDTO();

            $dto->client = $obj->getClient();
            $dto->payment = $obj->getPayment();
            $dto->gym = $obj->getGym();
            $dto->date_payment = $obj->getDatePayment();

            array_push($dados, $dto);
        }

        return $dados;
    }

    function search($dto)
    {
        $clientPaymentGym = new ClientPaymentGym();
        return $this->repository->findBy($this->cluentPaymentGymDTOtoEntity($dto,$clientPaymentGym));

    }

    private function cluentPaymentGymDTOtoEntity(ClientPaymentGymDTO $dto, ClientPaymentGym $entity): ClientPaymentGym
    {
        $entity->setId($dto->id);
        $entity->setDatePayment($dto->date_payment);
        $gym = array();
        foreach($dto->gym as $gym){
            $objGym = $this->gymRepository->findById($gym->id);
            array_push($gym, $objGym);
        }
        $entity->setGym($gym);
        $client = array();
        foreach($dto->client as $client){
            $objClient = $this->gymRepository->findById($client->id);
            array_push($client, $objClient);
        }
        $entity->setClient($client);
        $payment = array();
        foreach($dto->payment as $payment){
            $objPayment = $this->paymentRepository->findById($payment->id);
            array_push($payment, $objPayment);
        }
        $entity->setPayment($payment);

        return $entity;
    }

    function delete($id)
    {
        try {
            $this->repository->delete($id);
        } catch (QueryException $e) {
            return response()->json('Not ok', Response::HTTP_CREATED);
        }
        return response()->json('ok', Response::HTTP_CREATED);
    }
}