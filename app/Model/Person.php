<?php


namespace App\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity
 * @ORM\Table(name="person")
 */
class Person
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(name="id", type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(name="name", type="string")
     */
    protected $name;

    /**
     * @ORM\Column(name="cpf", type="string")
     */
    protected $cpf;

    /**
     * @ORM\Column(name="rg", type="string")
     */
    protected $rg;

    /**
     * @ORM\Column(name="phone", type="string")
     */
    protected $phone;

    /**
     * @ORM\OneToMany(targetEntity="App\Model\Address", mappedBy="person")
     */
    protected $address;

    /**
     * @ORM\Column(name="birthday", type="date")
     */
    protected $birthDay;

    /**
     * @ORM\Column(name="height", type="decimal")
     */
    protected $heigth;

    /**
     * @ORM\Column(name="weight", type="decimal")
     */
    protected $weight;

    public function __construct()
    {
        $this->address = new ArrayCollection();
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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getCpf()
    {
        return $this->cpf;
    }

    /**
     * @param mixed $cpf
     */
    public function setCpf($cpf): void
    {
        $this->cpf = $cpf;
    }

    /**
     * @return mixed
     */
    public function getRg()
    {
        return $this->rg;
    }

    /**
     * @param mixed $rg
     */
    public function setRg($rg): void
    {
        $this->rg = $rg;
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param mixed $phone
     */
    public function setPhone($phone): void
    {
        $this->phone = $phone;
    }

    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param mixed $address
     */
    public function setAddress($address): void
    {
        $this->address = $address;
    }

    /**
     * @return mixed
     */
    public function getBirthDay()
    {
        return $this->birthDay;
    }

    /**
     * @param mixed $birthDay
     */
    public function setBirthDay($birthDay): void
    {
        $this->birthDay = $birthDay;
    }

    /**
     * @return mixed
     */
    public function getHeigth()
    {
        return $this->heigth;
    }

    /**
     * @param mixed $heigth
     */
    public function setHeigth($heigth): void
    {
        $this->heigth = $heigth;
    }

    /**
     * @return mixed
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * @param mixed $weight
     */
    public function setWeight($weight): void
    {
        $this->weight = $weight;
    }

}