<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Product
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     * ???
     */
    private ?int $id = null;

    /**
     * @ORM\Column(type="float")
     */
    private float $x;

    /**
     * @ORM\Column(type="float")
     */
    private float $y;

    /**
     * @ORM\Column(type="float")
     */
    private float $z;

    /**
     * @ORM\Column(type="float")
     */
    private float $weight;

    /**
     * @ORM\Column(type="integer")
     */
    private float $quantity;


    //@todo productID .. n to n

    public function __construct(float $x, float $y, float $z, float $weight, int $quantity)
    {
        $this->x = $x;
        $this->y = $y;
        $this->z = $z;
        $this->weight = $weight;
        $this->quantity = $quantity;
    }
}
