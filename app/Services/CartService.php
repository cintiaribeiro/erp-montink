<?php

namespace App\Services;

use App\Models\Stock;

class CartService
{
    public function showCart()
    {
        return view('cart.show');
    }

    public function addCart($request)
    {
        $data = $request->all();
        $product = json_decode($data['product']);

        $stock = Stock::where('id', $data['variation'])->first();

        $cart = session()->get('cart', []);

        $key = $product->id . '_' . $data['variation'];

        if (isset($cart['items'][$key])) {
            $amount = $cart['items'][$key]['stock_amount'] + $data['amount'];
            $total = ( $cart['items'][$key]['stock_amount'] += $data['amount']) * $product->price;
            $cart['items'][$key]['stock_amount'] = $amount;
            $cart['items'][$key]['total'] = $total;
        }else {

            $cart['items'][$key] = [
                'product_id' => $product->id,
                'product_name' => $product->name,
                'product_price' => $product->price,
                'stock_id' => $stock->id,
                'stock_variation' => $stock->variation,
                'stock_amount' => $data['amount'],
                'total' => $data['amount'] * $product->price
            ];
        }

        $totalValor = collect($cart['items'])->reduce(function ($carry, $item) {
            return $carry + $item['total'];
        }, 0);

        $freight = 20.00;


        if(($totalValor >  52) && ($totalValor < 166.59)){
            $freight = 15.00;
        }
        if($totalValor > 200){
            $freight = 0.00;
        }

        $cart['cart_subtotal'] = $totalValor;
        $cart['freight'] = $freight;


        session()->put('cart', $cart);

        return redirect()->route('stores.show', $product->uuid)->with('success', 'Produto adicionado ao carrinho!');
    }

    public function finishCart()
    {
        return view('cart.finish');
    }

}
