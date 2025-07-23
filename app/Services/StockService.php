<?php

namespace App\Services;

use App\Models\Stock;

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

    public function validaAmountStock($items)
    {
        foreach ($items as $item) {
            $stock = Stock::where('id', $item['stock_id'])->first();
            $amount = $stock->amount;

            if($amount < $item['stock_amount']){
                return redirect()->back()->with('error', "Erro ao adicionar o produto {$stock->product->name} no carrinho!");
            }
        }
    }

    public function updateStockVariation($items)
    {
        foreach ($items as $item) {
            $stock = Stock::where('id', $item['stock_id'])->first();
            $amount = $stock->amount - $item['stock_amount'];
            $stock->update(['amount' => $amount]);
        }
    }

}
