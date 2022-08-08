<?php

namespace App\Facade;

use App\Decoder\ProductDecoder;

class PackagingCalculationFacade
{
    private ProductDecoder $productDecoder;

    public function __construct(ProductDecoder $productDecoder)
    {
        $this->productDecoder = $productDecoder;
    }

    public function run(string $json)
    {
        $list = $this->productDecoder->decode($json);

        return $list;
    }
}
