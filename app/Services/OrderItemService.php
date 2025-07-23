<?php

namespace App\Services;

use App\Models\OrderItem;

class OrderItemService
{
    public function __construct(private OrderItem $orderItem){}

    public function storeOrderItem($order, $items)
    {
        foreach ($items as $item) {
            $data = [
                'order_id' => $order->id,
                'product_id' => $item['product_id'],
                'stock_id' => $item['stock_id'],
                'amount' => $item['stock_amount']
            ];

            $this->orderItem->create($data);
        }

    }


}
