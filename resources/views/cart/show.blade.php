@php
   $carItems = session('cart', []);
   $items = isset($carItems['items']) ? $carItems['items'] : [];
@endphp
@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Carrinho</h5>
                    <h6 class="card-subtitle mb-2 text-body-secondary">Produtos do carrinho</h6>
                    <hr>
                    @forelse($items as $item)
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <img src="https://placehold.co/150x200/f2efef/FFFFFF/png" alt="">
                            </div>
                            <div class="col-md-7">
                                <p><strong>{{ $item['product_name'] }}</strong></p>
                                <small>{{ $item['stock_variation'] }}</small>
                                <p>Quantidade: {{ $item['stock_amount'] }}</p>
                            </div>
                            <div class="col-md-2">
                                <strong>R$ {{ number_format($item['product_price'], 2, ',', '.') }}</strong>
                            </div>
                        </div>
                    @empty
                        Não há produtos no carrinho
                    @endforelse
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Resumo da compra</h5>
                    <hr>
                    <div class="row">
                        <div class="d-flex justify-content-between align-items-center">
                            <p>Produto({{ collect(session('cart.items'))->sum('stock_amount') }})</p>
                            <p>R$ {{ ($carItems) ? number_format($carItems['cart_subtotal'], 2, ',', '.'): '' }}</p>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <p>Frete</p>
                            <p>R$ {{ ($carItems) ? number_format($carItems['freight'], 2, ',', '') : '' }}</p>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <p>Total</p>
                            <p id="total">R$ {{ ($carItems) ? number_format( ($carItems['cart_subtotal'] + $carItems['freight']), 2, ',','.' ) : '' }}</p>
                        </div>
                    </div>
                    <div class="row d-flex flex-column gap-2 mt-3">
                        <div class="d-grid">
                            <a href="{{ route('carts.finish') }}" class="btn btn-green">Finalizar compra</a>
                        </div>
                        <div class="d-grid">
                            <a href="{{ route('stores.index') }}" class="btn btn-pink">Continuar comprando</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
