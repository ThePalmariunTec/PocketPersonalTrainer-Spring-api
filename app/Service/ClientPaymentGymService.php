<?php


namespace App\Service;


use App\DTO\ClientPaymentGymDTO;
use App\Model\ClientPaymentGym;
use App\Repository\ClientPaymentGymRepository;
use App\Service\Interfaces\BaseServiceInterface;
use Doctrine\ORM\Query\QueryException;
use Illuminate\Http\Response;

class ClientPaymentGymService implements BaseServiceInterface
{

    private $repository;
    private $clientRepository;
    private $gymRepository;
    private $paymentRepository;


    public function __construct(ClientPaymentGymRepository $repository)
    {
        $this->repository = $repository;
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
            $dto->client_id = $obj->getClientId();
            $dto->payment_id = $obj->getPaymentId();
            $dto->gym_id = $obj->getGymId();
            $dto->date_payment = $obj->getDatePayment();

            array_push($dados, $dto);
        }

        return $dados;
    }

    function search($dto)
    {
        $clientPaymentGym = new ClientPaymentGym();
        $dto = $this->repository->findBy($this->cluentPaymentGymDTOtoEntity($dto,$clientPaymentGym));

        return $dto;
    }

    private function cluentPaymentGymDTOtoEntity(ClientPaymentGymDTO $dto, ClientPaymentGym $entity): ClientPaymentGym{
        $entity->setClientId($dto->client_id);
        $entity->setDatePayment($dto->date_payment);
        $entity->setGymId($dto->gym_id);
        $entity->setPaymentId($dto->payment_id);

        return entity;
    }

    function delete($id)
    {
        try {
            $clientPaymentGym = new ClientPaymentGym();
            $this->repository->delete($id);
        } catch (QueryException $e) {
            return response()->json('Not ok', Response::HTTP_CREATED);
        }
        return response()->json('ok', Response::HTTP_CREATED);
    }
}