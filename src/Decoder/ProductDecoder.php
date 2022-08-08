<?php

namespace App\Decoder;

use App\DTO\ProductDTO;

class ProductDecoder
{
    /**
     * @return ProductDTO[]
     * @todo In Symfony can by use Symfony/Decoder .. with Normalizer
     */
    public function decode(string $json): array
    {
        $productsArray = json_decode($json, true);

        $productDTOs = [];

        foreach ($productsArray['products'] as $productArray) {
            $this->fixSameProduct($productDTOs, ProductDTO::fromArray($productArray));
        }

        return $productDTOs;
    }

    /**
     * @param ProductDTO[] $products
     */
    private function fixSameProduct(array &$products, ProductDTO $productDTO): void
    {
        foreach ($products as $product) {
            if ($product->isSame($productDTO)) {
                $product->quantity += $productDTO->quantity;
                return;
            }
        }

        $products[] = $productDTO;
    }
}
