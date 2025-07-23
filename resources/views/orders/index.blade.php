@extends('layouts.app')
@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                @include('message')
                <h5 class="card-title">Pedidos</h5>

                <h6 class="card-subtitle mb-2 text-body-secondary">Pedidos realizados</h6>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Número</th>
                        <th>Cliente</th>
                        <th>Forma de pagamento</th>
                        <th>Valor</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse ($orders as $order)
                        <tr>
                            <td>{{ $order->number }}</td>
                            <td>{{ $order->name_client }}</td>
                            <td>{{ $order->payment_method }}</td>
                            <td>{{ $order->total }}</td>
                            <td>{{ $order->getStatus() }}</td>
                            <td>
                                <a href="{{ route('orders.show', $order->uuid) }}" class="btn btn-green" >Visualizar</a>
{{--                                <a href="{{ route('products.edit', $product->uuid) }}" class="btn btn-pink">Editar</a>--}}
{{--                                <form action="{{ route('products.destroy', $product->uuid) }}" method="POST" class="d-inline" onsubmit="return confirm('Tem certeza que deseja excluir o produto?')">--}}
{{--                                    @csrf--}}
{{--                                    @method('DELETE')--}}
{{--                                    <button type="submit" class="btn btn-secondary">Excluir</button>--}}
{{--                                </form>--}}
                            </td>
                        </tr>
                    @empty
                        <p>Nenhum produto cadastrado até o momento</p>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
