@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Produtos</h5>
                    <hr>
                    <div class="row">
                        <div class="col-md-3">
                            <img src="https://placehold.co/150x200/000000/FFFFFF/png" alt="">
                        </div>
                        <div class="col-md-7">
                            <p><strong>Produto1</strong></p>
                            <small>Tamanho p</small>
                            <p>Quantidade: 1</p>
                        </div>
                        <div class="col-md-2">
                            <strong>R$ 10,00</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Resumo da compra</h5>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <p>Produto(1)</p>
                            <p>Frete</p>
                            <p>Desconto</p>
                            <p>Total</p>
                        </div>
                        <div class="col-md-6">
                            <p>R$ 10,00</p>
                            <p>R$ 13,00</p>
                            <p>-</p>
                            <p>R$ 23,00</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="d-grid">
                            <a href="" class="btn btn-green">Finalizar compra</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
