@extends('layouts.app')
@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                @include('message')
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="card-title">Produtos</h5>
                    <a href="{{ route('products.create') }}" class="btn btn-green">Cadastrar novo produto</a>
                </div>
                <h6 class="card-subtitle mb-2 text-body-secondary">Produtos cadastrados</h6>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Variações</th>
                            <th>Estoque</th>
                            <th>Preço</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $product)
                            <tr>
                                <td>{{ $product->name }}</td>
                                <td></td>
                                <td></td>
                                <td>{{ $product->price }}</td>
                                <td>
                                    <a href="{{ route('products.edit', $product->uuid) }}" class="btn btn-blue">Editar</a>
                                    <form action="{{ route('products.destroy', $product->uuid) }}" method="POST" class="d-inline" onsubmit="return confirm('Tem certeza que deseja excluir o produto?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-red" >Excluir</button>
                                    </form>
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
