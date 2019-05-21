<?php


namespace App\Model;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="gym")
 */
class Gym
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
     * @ORM\OneToMany(targetEntity="App\Model\Address", mappedBy="gym")
     */
    protected $address;

    /**
     * @ORM\OneToMany(targetEntity="App\Model\Address", mappedBy="gym")
     */
    protected $user;
}