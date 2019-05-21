<?php


namespace App\Model;

use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity
 * @ORM\Table(name="client_payment_gym")
 */
class ClientPaymentGym
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(name="id", type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(name="date_payment", type="date")
     */
    protected $datePayment;

    /**
     * @ORM\OneToMany(targetEntity="App\Model\Client", mappedBy="client")
     */
    protected $client;

    /**
     * @ORM\OneToMany(targetEntity="App\Model\Payment", mappedBy="payment")
     */
    protected $payment;

    /**
     * @ORM\OneToMany(targetEntity="App\Model\Gym", mappedBy="payment")
     */
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