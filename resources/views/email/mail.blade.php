<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Confirmação de Pedido</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f7f7f7;
            color: #333;
            padding: 20px;
        }

        .container {
            background: #ffffff;
            padding: 20px;
            border-radius: 8px;
            max-width: 600px;
            margin: auto;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        h1 {
            color: #4CAF50;
        }

        .details {
            margin-top: 20px;
        }

        .details p {
            margin: 5px 0;
        }

        table {
            width: 100%;
            margin-top: 15px;
            border-collapse: collapse;
        }

        table th, table td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        .total {
            font-weight: bold;
            font-size: 1.1em;
        }

        .footer {
            margin-top: 30px;
            font-size: 0.9em;
            color: #999;
            text-align: center;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Pedido Confirmado!</h1>

    <p>Olá {{ $order->name_client }},</p>

    <p>Obrigado pela sua compra. Aqui estão os detalhes do seu pedido:</p>

    <div class="details">
        <p><strong>Número do Pedido:</strong> {{ $order->number }}</p>
        <p><strong>Data da Compra:</strong> {{ $order->created_at }}</p>
        <p><strong>Forma de Pagamento:</strong> {{ $order->payment_method }}</p>
    </div>

    <h3>Produtos:</h3>
    <table>
        <thead>
        <tr>
            <th>Produto</th>
            <th>Qtd</th>
            <th>Preço Unitário</th>
            <th>Total</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($order->orderItems as $item)
            <tr>
                <td>{{ $item->product->name }}</td>
                <td>{{ $item->amount }}</td>
                <td>R$ {{ number_format(optional($item->product)->price, 2, ',', '.') }}</td>
                <td>R$ {{ number_format(optional($item->product)->price * $item->amount, 2, ',', '.') }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <p class="total">Subtotal: R$ {{ number_format($order->subtotal, 2, ',', '.') }}</p>
    <p class="total">Frete: R$ {{ number_format($order->freight, 2, ',', '.') }}</p>
    <p class="total">Desconto: R$ {{ number_format(optional($order->coupon)->discount, 2, ',', '.') }}</p>
    <p class="total">Total: <strong>R$ {{ number_format($order->total, 2, ',', '.') }}</strong></p>

    <div class="footer">
        Se tiver dúvidas, entre em contato com nosso suporte.
    </div>
</div>
</body>
</html>
