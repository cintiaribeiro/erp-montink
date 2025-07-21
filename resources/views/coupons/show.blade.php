@extends('layouts.app')

@section('content')

    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <h5 class="card-title">Cupons</h5>
                    <div>
                        <a href="{{ route('coupons.edit', $coupon->uuid) }}" class="btn btn-green">Editar</a>
                        <form action="{{ route('coupons.destroy', $coupon->uuid) }}" method="POST" class="d-inline" onsubmit="return confirm('Tem certeza que deseja excluir?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-pink">Excluir</button>
                        </form>
                    </div>
                </div>
                <h6 class="card-subtitle mb-2 text-body-secondary">Dados do cupom</h6>
                <form class="mt-4">
                    @csrf
                    <div class="row">
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="name" class="form-label">Código do cupom</label>
                                <p class="form-control">{{ $coupon->code }}</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="price" class="form-label">Valor do desconto</label>
                                <p class="form-control">{{ $coupon->discount}}</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="price" class="form-label">Valor mínimo da compra</label>
                                <p class="form-control">{{ $coupon->minimum_value}}</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="price" class="form-label">Validade</label>
                                <p class="form-control">{{ $coupon->expiration_date}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 d-flex justify-content-end gap-3">
                            <a href="{{ route('coupons.index') }}" class="btn btn-pink">Voltar</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

