<?php


namespace App\Model;
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity
 * @ORM\Table(name="payment")
 */
class Payment
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(name="id", type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(name="value", type="decimal")
     */
    protected $value;

    /**
     * @ORM\Column(name="pay_status", type="integer")
     */
    protected $pay;
}