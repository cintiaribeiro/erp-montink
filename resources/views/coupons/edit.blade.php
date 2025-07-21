@extends('layouts.app')

@section('content')

    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Cupons</h5>
                <h6 class="card-subtitle mb-2 text-body-secondary">Atualizar cupom</h6>
                <form class="mt-4" action="{{ route('coupons.update', $coupon->uuid) }}" method="post">
                    @method('PUT')
                    @csrf
                    <div class="row">
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="name" class="form-label">Código do cupom</label>
                                <input type="text" class="form-control" id="code" name="code" value="{{ $coupon->code }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="price" class="form-label">Valor do desconto</label>
                                <input type="number" class="form-control" id="discount" name="discount" step="0.01" min="0" value="{{ $coupon->discount }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="price" class="form-label">Valor mínimo da compra</label>
                                <input type="number" class="form-control" id="minimum_value" name="minimum_value" step="0.01" min="0" value="{{ $coupon->minimum_value }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="price" class="form-label">Validade</label>
                                <input type="date" class="form-control" id="expiration_date" name="expiration_date" value="{{ $coupon->expiration_date->format('Y-m-d') }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 d-flex justify-content-end gap-3">
                            <button type="submit" class="btn btn-green">Atualizar cupom</button>
                            <a href="{{ route('coupons.index') }}" class="btn btn-pink">Voltar</a>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
