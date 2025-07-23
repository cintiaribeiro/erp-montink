<?php

namespace App\Services;

use App\Mail\OrderShipped;
use App\Models\Order;
use Illuminate\Support\Facades\Mail;

class OrderService
{
    public function __construct(
        private Order $order,
        private OrderItemService $orderItemService,
        private StockService $stockService
    ){}

    public function allOrders()
    {
        $orders = $this->order->all();
        return view('orders.index', compact('orders'));
    }

    public function showOrder($order)
    {
        return view('orders.show', compact('order'));
    }
    public function storeOrder($request)
    {
        $data = $request->all();
        $carItems = session('cart', []);

        try {

            \DB::beginTransaction();
            $this->stockService->validaAmountStock($carItems['items']);

            $orderData = [
                'number' => now()->format('Ymd').random_int(1, 100),
                'coupon_id' => $data['coupon_id'],
                'freight' => $carItems['freight'],
                'subtotal' => $carItems['cart_subtotal'],
                'total' => number_format((float) $data['total'], 2, '.', ','),
                'name_client' => $data['name_client'],
                'email_client' => $data['email_client'],
                'payment_method' => $data['payment_method'],
            ];

            $order = $this->order->create($orderData);
            $this->orderItemService->storeOrderItem($order, $carItems['items']);
            $this->stockService->updateStockVariation($carItems['items']);
            \DB::commit();


            Mail::to($data['email_client'])->send(new OrderShipped($order));

            session()->forget('cart');

            return redirect()->route('stores.index')->with('success', "Pedido realizada com sucesso! \n Um email foi enviado para {$data['email_client']} com os detalhes do seu pedido.");
        }catch (\Exception $e){
            \DB::rollBack();
            return redirect()->route('stores.index')->with('error', "Erro ao finalizar o pedido");
        }


    }
}
