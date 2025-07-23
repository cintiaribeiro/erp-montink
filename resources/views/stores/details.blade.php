
@extends('layouts.app')

@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Produtos</h5>
                <h6 class="card-subtitle mb-5 text-body-secondary">Detalhes produto</h6>
                <form action="" method="POST">
                    @csrf
                    <input type="hidden" name="product" value="{{ $product }}">
                    <div class="row">
                    <div class="d-flex justify-content-between">
                        <div class="d-flex justify-content-start align-items-center gap-2">
                            <div>
                                <ul>
                                    <li  class="p-1 list-group-item border mb-2">
                                        <img src="https://placehold.co/50X50/e2e0e0/FFFFFF/png" alt="">
                                    </li>
                                    <li class="p-1 list-group-item border mb-2">
                                        <img src="https://placehold.co/50X50/e2e0e0/FFFFFF/png" alt="">
                                    </li>
                                    <li class="p-1 list-group-item border mb-2">
                                        <img src="https://placehold.co/50X50/e2e0e0/FFFFFF/png" alt="">
                                    </li>
                                    <li class="p-1 list-group-item border mb-2">
                                        <img src="https://placehold.co/50X50/e2e0e0/FFFFFF/png" alt="">
                                    </li>
                                    <li class="p-1 list-group-item border mb-2">
                                        <img src="https://placehold.co/50X50/e2e0e0/FFFFFF/png" alt="">
                                    </li>
                                </ul>
                            </div>
                            <div>
                                <img src="https://placehold.co/310X310/e2e0e0/FFFFFF/png" alt="">
                            </div>
                            <div class="p-2 d-flex gap-2 flex-column">
                                <p class="mb-0"><Strong>{{ $product->name }}</Strong></p>
                                <select class="form-select" name="variation" id="variation">
                                    @foreach($product->stocks as $stock)
                                    <option value="{{ $stock->id }}" data-stock="{{ $stock->amount }}">{{ $stock->variation }}</option>
                                    @endforeach
                                </select>
                                <p><strong>R$ {{ number_format($product->price, 2, ',', '.') }}</strong></p>
                            </div>
                        </div>
                        <div class="d-flex flex-column border rounded p-4 gap-2">
                            <p><strong>R$ {{ number_format($product->price, 2, ',', '.') }} </strong></p>
                            <select class="form-select" name="amount" id="amount">

                            </select>

                            <button id="submitBtn" type="submit" class="btn btn-green">
                                <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true" id="loader"></span>
                                <span id="btnText">Adicionar ao carrinho</span>
                            </button>

                            <a href="{{ route('stores.index') }}" class="btn btn-pink">Continuar comprando</a>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const variationSelect = document.querySelector('#variation');
            const amountSelect = document.querySelector('#amount');

            let stock =  variationSelect.options[variationSelect.selectedIndex].dataset.stock;
            updateAmount(stock);

            variationSelect.addEventListener('change', function () {
                stock = this.options[this.selectedIndex].dataset.stock;
                updateAmount(stock);
            })

            function updateAmount(stock) {
                amountSelect.innerHTML = '';

                const max = parseInt(stock);
                for (let i = 1; i <= max; i++) {
                    const option = document.createElement('option');
                    option.value = i;
                    option.textContent = i;
                    amountSelect.appendChild(option);
                }
            }

            const form = document.getElementById('add-to-cart-form');
            const btn = document.getElementById('submitBtn');
            const loader = document.getElementById('loader');
            const btnText = document.getElementById('btnText');

            form.addEventListener('submit', function () {
                loader.classList.remove('d-none'); // mostra o loader
                btnText.textContent = 'Enviando...';
                btn.disabled = true;
            });
        })
    </script>
@endsection
