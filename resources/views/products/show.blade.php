@extends('layouts.app')

@section('content')

    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <h5 class="card-title">Produtos</h5>
                    <div>
                        <a href="{{ route('products.edit', $product->uuid) }}" class="btn btn-green">Editar</a>
                        <form action="{{ route('products.destroy', $product->uuid) }}" method="POST" class="d-inline" onsubmit="return confirm('Tem certeza que deseja excluir?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-pink">Excluir</button>
                        </form>
                    </div>
                </div>

                <h6 class="card-subtitle mb-2 text-body-secondary">Dados do produto</h6>


                <img src="https://placehold.co/200X200/e2e0e0/FFFFFF/png" alt="">

                <form class="mt-3">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="mb-3">
                                <label for="name" class="form-label">Nome</label>
                                <p class="form-control">{{ $product->name }}</p>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="price" class="form-label">Preço</label>
                                <p class="form-control">{{ $product->price }}</p>
                            </div>
                        </div>
                    </div>
                    <h5>Dados do estoque</h5>
                    @if($product->stocks->count())
                        @foreach($product->stocks as $stock)
                            <div id="variations">
                                <div class="row variation-item">
                                    <div class="col-md-5">
                                        <div class="mb-3">
                                            <label for="stock[0][variation]" class="form-label">Variação</label>
                                            <input type="text" class="form-control" name="stock[0][variation]" value="{{ $stock->variation }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="mb-3">
                                            <label for="stock[0][amount]" class="form-label">Quantidade</label>
                                            <p class="form-control">{{ $stock->amount }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif

                    <hr>
                    <div class="col-md-12 d-flex justify-content-end gap-3">
                        <a href="{{ route('products.index') }}" class="btn btn-pink">Voltar</a>

                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
