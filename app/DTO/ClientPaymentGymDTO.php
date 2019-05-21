<?php


namespace App\DTO;


use Doctrine\Common\Collections\ArrayCollection;

class ClientPaymentGymDTO
{
    public $id;

    public $client;

    public $payment;

    public $date_payment;

    public $gym;


    public function __construct()
    {
        $this->client = new ArrayCollection();
        $this->gym = new ArrayCollection();
        $this->payment = new ArrayCollection();
    }
}