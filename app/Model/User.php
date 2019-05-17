<?php


namespace App\Model;

use Doctrine\Common\Collections\ArrayCollection;
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
    protected $userName;

    /**
     * @ORM\Column(name="password", type="string")
     */
    protected $password;
    /**
     * @ORM\Column(name="email_id", type="integer")
     */
    protected $email;

    /**
     * @ORM\Column(name="role_id", type="integer")
     */
    protected $roles;

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
    public function getUserName()
    {
        return $this->userName;
    }

    /**
     * @param mixed $userName
     */
    public function setUserName($userName): void
    {
        $this->userName = $userName;
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
    public function getUserRole()
    {
        return $this->userRole;
    }

    /**
     * @param mixed $userRole
     */
    public function setUserRole($userRole): void
    {
        $this->userRole = $userRole;
    }
}