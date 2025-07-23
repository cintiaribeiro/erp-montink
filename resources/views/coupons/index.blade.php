@extends('layouts.app')
@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                @include('message')
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="card-title">Cupons</h5>
                    <a href="{{ route('coupons.create') }}" class="btn btn-green">Cadastrar novo Cupom</a>
                </div>
                <h6 class="card-subtitle mb-2 text-body-secondary">Cupons cadastrados</h6>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>code</th>
                        <th>Valor do desconto</th>
                        <th>Validade</th>
                        <th>Valor mínimo da compra</th>
                        <th>Ações</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse ($coupons as $coupon)
                        <tr>
                            <td>{{ $coupon->code }}</td>
                            <td>{{ $coupon->discount }}</td>
                            <td>{{ $coupon->expiration_date->format('d-m-Y') }}</td>
                            <td>{{ $coupon->minimum_value }}</td>
                            <td>
                                <a href="{{ route('coupons.show', $coupon->uuid) }}" class="btn btn-green">Visualizar</a>
                                <a href="{{ route('coupons.edit', $coupon->uuid) }}" class="btn btn-pink">Editar</a>
                                <form action="{{ route('coupons.destroy', $coupon->uuid) }}" method="POST" class="d-inline" onsubmit="return confirm('Tem certeza que deseja excluir o cupom?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-secondary" >Excluir</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <p>Nenhum cupom cadastrado até o momento</p>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
