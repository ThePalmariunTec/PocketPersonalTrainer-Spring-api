<?php


namespace App\Model;

use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity
 * @ORM\Table(name="person")
 */
class User
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(name="id", type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(name="user_name", type="string")
     */
    protected $name;

    /**
     * @ORM\Column(name="password", type="string")
     */
    protected $password;
    /**
     * @ORM\Column(name="email_id", type="integer")
     */
    protected $email;

    /**
     * @ORM\OneToMany(targetEntity="App\Model\Roles", mappedBy="user")
     */
    protected $roles;

    /**
     * @ORM\ManyToOne(targetEntity="client", inversedBy="user", cascade={"persist", "merge", "remove"})
     */
    protected $client;
    /**
     * @ORM\ManyToOne(targetEntity="employee",inversedBy="user", cascade={"persist", "merge", "remove"})
     */
    protected $employee;

    /**
     * @ORM\ManyToOne(targetEntity="gym",inversedBy="user", cascade={"persist", "merge", "remove"})
     */
    protected $gym;

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
    public function setUserName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password): void
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email): void
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * @param mixed $roles
     */
    public function setRoles($roles): void
    {
        $this->roles = $roles;
    }

}