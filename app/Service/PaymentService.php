<?php


namespace App\Service;


use App\DTO\PaymentDTO;
use App\Model\Payment;
use App\Repository\PaymentRepository;
use App\Service\Interfaces\BaseServiceInterface;
use Doctrine\ORM\Query\QueryException;
use Illuminate\Http\Response;

class PaymentService implements BaseServiceInterface
{
    private $repository;

    public function __construct(PaymentRepository $paymentRepository)
    {
        $this->repository = $paymentRepository;
    }

    function insert($dto)
    {
        try {
            $payment = new Payment();
            $this->repository->insert($this->paymentDTOtoEntity($dto,$payment));
        } catch (QueryException $e) {

            return response()->json('Not ok', Response::HTTP_CREATED);
        }

        return response()->json('ok', Response::HTTP_CREATED);
    }

    function update($dto)
    {
        try {
            $payment = new Payment();
            $this->repository->update($this->paymentDTOtoEntity($dto,$payment));
        } catch (QueryException $e) {

            return response()->json('Not ok', Response::HTTP_CREATED);
        }

        return response()->json('ok', Response::HTTP_CREATED);
    }

    function findById($id)
    {
        return $this->repository->findById($id);
    }

    function findAll()
    {

        $objs = $this->repository->findAll();
        $dados = array();
        foreach ($objs as $obj){
            $dto = new PaymentDTO();
            $dto->id = $obj->getId();
            $dto->value = $obj->getValue();
            $dto->pay = $obj->getPay();

            array_push($dados, $dto);
        }

        return $dados;
    }

    function search($dto)
    {
        $payment = new Payment();
        return $this->repository->findBy($this->paymentDTOtoEntity($dto, $payment));
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

    private function paymentDTOtoEntity(PaymentDTO $dto, Payment $entity): Payment
    {
        $entity->setId($dto->id);
        $entity->setValue($dto->value);
        $entity->setPay($dto->pay);

        return $entity;
    }
}