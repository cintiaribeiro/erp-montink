<?php

namespace App\Services;

class StockService
{
    public function storeStock($dataStock, $product)
    {
        $product->stocks()->createMany($dataStock);

    }

    public function updateStock($dataStock, $product)
    {
        $product->stocks()->delete();
        $product->stocks()->createMany($dataStock);
    }

}
