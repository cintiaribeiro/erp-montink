<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class WebhookOrderController extends Controller
{
    private $webhookSecret = 'secretwebhook';

    private $statusMap = [
        'em processo' => 1,
        'pago'     => 2,
        'cancelado'=> 3,
        'entregue' => 4,
    ];

    public function updateOrderStatus(Request $request)
    {
        $headerToken = $request->header('X-Webhook-Secret');

        if ($headerToken !== $this->webhookSecret) {
            return response()->json(['error' => 'Token inválido.'], 401);
        }

        // Validação
        $validated = $request->validate([
            'id' => 'required|integer|exists:orders,id',
            'status' => 'required',
        ]);
        $status = $validated['status'];
        if (is_string($status)) {
            $status = strtolower($status);
            if (!isset($this->statusMap[$status])) {
                return response()->json(['error' => 'Status inválido.'], 422);
            }

            $status = $this->statusMap[$status];
        }

        $order = Order::find($validated['id']);

        if($status == 3){
            $items = $order->orderItems;
            foreach ($items as $item){
               $stock = $item->stock;
               $amount = $stock->amount + $item->amount;
               $stock->update(['amount' => $amount]);
            }
        }

        $order->status = $status;
        $order->save();

        return response()->json(['message' => 'Status do pedido atualizado com sucesso!']);

    }
}
