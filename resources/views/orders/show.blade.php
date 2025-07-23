@extends('layouts.app')

@section('content')

    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <h5 class="card-title">Pedido</h5>
                </div>
                <h6 class="card-subtitle mb-2 text-body-secondary">Dados do pedido</h6>
                <form class="mt-3">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="name" class="form-label">Numero</label>
                                <p class="form-control">{{ $order->number }}</p>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="name" class="form-label">Nome do cliente</label>
                                <p class="form-control">{{ $order->name_client }}</p>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="name" class="form-label">Email do cliente</label>
                                <p class="form-control">{{ $order->email_client }}</p>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="name" class="form-label">Subtotal</label>
                                <p class="form-control">{{ number_format($order->subtotal, 2, ',', '.') }}</p>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="name" class="form-label">Frete</label>
                                <p class="form-control">{{ number_format($order->freight, 2, ',', '.') }}</p>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="name" class="form-label">Cupom</label>
                                <p class="form-control">{{ number_format(optional($order->coupon)->discount, 2, ',', '.') }}</p>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="name" class="form-label">Forma de pagamento</label>
                                <p class="form-control">{{ $order->payment_method }}</p>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="name" class="form-label">Status</label>
                                <p class="form-control">{{ $order->getStatus() }}</p>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="col-md-12 d-flex justify-content-end gap-3">
                        <a href="{{ route('orders.index') }}" class="btn btn-pink">Voltar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
