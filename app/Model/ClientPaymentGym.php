<?php


namespace App\Model;


class ClientPaymentGym
{


    protected $id;

    protected $datePayment;

    protected $client;

    protected $payment;

    protected $gym;

    public function __construct()
    {
        $this->client = new Client();
        $this->gym = new Gym();
        $this->payment = new Payment();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getDatePayment()
    {
        return $this->datePayment;
    }

    /**
     * @param mixed $datePayment
     */
    public function setDatePayment($datePayment): void
    {
        $this->datePayment = $datePayment;
    }

    /**
     * @return mixed
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @param mixed $client
     */
    public function setClient($client): void
    {
        $this->client = $client;
    }

    /**
     * @return mixed
     */
    public function getPayment()
    {
        return $this->payment;
    }

    /**
     * @param mixed $payment
     */
    public function setPayment($payment): void
    {
        $this->payment = $payment;
    }

    /**
     * @return mixed
     */
    public function getGym()
    {
        return $this->gym;
    }

    /**
     * @param mixed $gym
     */
    public function setGym($gym): void
    {
        $this->gym = $gym;
    }

    
}