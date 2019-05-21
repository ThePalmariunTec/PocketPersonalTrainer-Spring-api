<?php


namespace App\Model;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="roles")
 */

class Roles
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(name="id", type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(name="rating", type="integer")
     */
    protected $rating;

    /**
     * @ORM\Column(name="description", type="string")
     */
    protected $description;
}