<?php

namespace App\DTO;

class ProductDTO
{
    public float $x;

    public float $y;

    public float $z;

    public float $weight;

    public int $quantity = 1;

    public static function fromArray(array $productArray): self
    {
        $productDTO = new self();
        $sortData = [$productArray['width'], $productArray['height'], $productArray['length']];
        sort($sortData);
        $productDTO->x = $sortData[0];
        $productDTO->y = $sortData[1];
        $productDTO->z = $sortData[2];
        $productDTO->weight = $productArray['weight'];

        return $productDTO;
    }

    public function isSame(ProductDTO $product): bool
    {
        if (
            $this->x == $product->x &&
             $this->y == $product->y &&
              $this->z == $product->z &&
               $this->weight == $product->weight
        ) {
            return true;
        }

        return false;
    }
}
