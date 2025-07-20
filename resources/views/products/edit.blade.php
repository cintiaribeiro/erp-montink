@extends('layouts.app')

@section('content')

    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Produtos</h5>
                <h6 class="card-subtitle mb-2 text-body-secondary">Cadastro de produto</h6>
                <form class="mt-4" action="{{ route('products.update', $product->uuid) }}" method="post">
                    @method('PUT')
                    @csrf
                    <div class="row">
                        <div class="col-md-8">
                            <div class="mb-3">
                                <label for="name" class="form-label">Nome</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ $product->name }}" >
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="price" class="form-label">Preço</label>
                                <input type="number" class="form-control" id="price" name="price" step="0.01" min="0" value="{{ $product->price }}">
                            </div>
                        </div>
                    </div>
                    <h5>Dados do estoque</h5>
                    <div id="variations">
                        @if($product->stocks->count())
                            @foreach($product->stocks as $key=>$stock)
                            <div class="row variation-item">
                                <div class="col-md-5">
                                    <div class="mb-3">
                                        <label for="stock[{{ $key }}][variation]" class="form-label">Variação</label>
                                        <input type="text" class="form-control" name="stock[{{ $key }}][variation]" value="{{ $stock->variation }}">
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="mb-3">
                                        <label for="stock[{{ $key }}][amount]" class="form-label">Quantidade</label>
                                        <input type="text" class="form-control" name="stock[{{ $key }}][amount]" value="{{ $stock->amount }}">
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-end justify-content-end">
                                    <div class="mb-3">
                                        <button type="button" class="btn btn-danger action-button">Remover</button>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        @endif
                        <div class="row variation-item">
                            <div class="col-md-5">
                                <div class="mb-3">
                                    <label for="stock[{{ $product->stocks->count() }}][variation]" class="form-label">Variação</label>
                                    <input type="text" class="form-control" name="stock[{{ $product->stocks->count() }}][variation]">
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="mb-3">
                                    <label for="stock[{{ $product->stocks->count() }}][amount]" class="form-label">Quantidade</label>
                                    <input type="text" class="form-control" name="stock[{{ $product->stocks->count() }}][amount]">
                                </div>
                            </div>
                            <div class="col-md-2 d-flex align-items-end justify-content-end">
                                <div class="mb-3">
                                    <button type="button" class="btn btn-pink action-button">Adicionar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="col-md-12 d-flex justify-content-end" >
                        <button type="submit" class="btn btn-green">Editar produto</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const container = document.getElementById('variations');
            let index = {{ $product->stocks->count() ? $product->stocks->count() + 1 : 1}};
            console.log(index);

            container.addEventListener('click', function (e) {
                const target = e.target;

                if (!target.classList.contains('action-button')) return;

                const isAdicionar = target.textContent.trim() === 'Adicionar';
                const isRemover = target.textContent.trim() === 'Remover';

                if (isAdicionar) {
                    const newItem = createVariationItem();
                    container.appendChild(newItem);
                    updateActionButtons();
                }

                if (isRemover) {
                    const row = target.closest('.variation-item');
                    if (row) {
                        row.remove();
                        updateActionButtons();
                    }
                }
            });

            function createVariationItem() {
                const div = document.createElement('div');
                div.classList.add('variation-item');
                div.classList.add('row'); // opcional, se usar Bootstrap ou grid

                div.innerHTML = `
                    <div class="col-md-5">
                        <div class="mb-3">
                            <label for="stock[0]['variation']" class="form-label">Variação</label>
                            <input type="text" class="form-control" name="stock[0]['variation']"></input>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="mb-3">
                            <label for="stock[0]['amount']" class="form-label">Quantidade</label>
                            <input type="text" class="form-control" name="stock[0]['amount']"></input>
                        </div>
                    </div>
                    <div class="col-md-2 d-flex align-items-end justify-content-end">
                        <div class="mb-3">
                            <button type="button" class="btn btn-pink action-button">Adicionar</button>
                        </div>
                    </div>
                `;

                return div;
            }

            function updateActionButtons() {
                const rows = container.querySelectorAll('.variation-item');

                rows.forEach((row, i) => {
                    const button = row.querySelector('.action-button');
                    if (!button) return;


                    if (i === rows.length - 1) {
                        button.textContent = 'Adicionar';
                        button.classList.remove('btn-danger');
                        button.classList.add('btn-pink');
                    } else {
                        button.textContent = 'Remover';
                        button.classList.remove('btn-pink');
                        button.classList.add('btn-danger');
                    }
                });
            }
        });

    </script>
@endsection
