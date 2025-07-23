@php
    $carItems = session('cart', []);
    $items = isset($carItems['items']) ? $carItems['items'] : [];
@endphp
@extends('layouts.app')

@section('content')
    @include('message')
    <form action="{{ route('orders.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Carrinho</h5>
                        <h6 class="card-subtitle mb-2 text-body-secondary">Finalizar compra</h6>
                        <hr>

                        <h5>Dados pessoais</h5>
                        <div class="mb-3">
                            <label for="name" class="form-label">Nome</label>
                            <input type="text" class="form-control" id="name" name="name_client" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">E-mail</label>
                            <input type="email" class="form-control" id="email-client" name="email_client" required>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Telefone <small>(99) 99999-9999</small></label>
                            <input type="phone" class="form-control" name="phone" id="phone" placeholder="(99) 99999-9999" pattern="\(\d{2}\)\s\d{5}-\d{4}" required>
                        </div>
                        <h5>Dados da entrega</h5>
                        <div class="mb-3">
                            <label for="cep" class="form-label">CEP</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="cep" name="cep" required>
                                <small id="cep-message" style="color: red;"></small>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="logradouro" class="form-label">Endereço</label>
                            <input type="text" class="form-control" id="logradouro" name="logradouro" required>
                        </div>
                        <div class="mb-3">
                            <label for="numero" class="form-label">Número</label>
                            <input type="text" class="form-control" id="numero" name="numero" required>
                        </div>
                        <div class="mb-3">
                            <label for="bairro" class="form-label">Bairro</label>
                            <input type="text" class="form-control" id="bairro" name="bairro" required>
                        </div>
                        <div class="mb-3">
                            <label for="cidade" class="form-label">Cidade</label>
                            <input type="text" class="form-control" id="cidade" name="cidade" required>
                        </div>
                        <div class="mb-3">
                            <label for="estado" class="form-label">Estado</label>
                            <input type="text" class="form-control" id="estado" name="estado" required>
                        </div>
                        <h5>Dados do pagamento</h5>
                        <div class="mb-3">
                            <label for="payment-method" class="form-label">Forma de pagamento</label>
                            <select class="form-select" name="payment_method" required>
                                <option></option>
                                <option value="pix">Pix</option>
                                <option value="boleto">Boleto</option>
                                <option value="cartão">Cartao</option>
                            </select>
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
                            <div class="d-flex justify-content-between align-items-center">
                                <p>Produto({{ collect(session('cart.items'))->sum('stock_amount') }})</p>
                                <p>R$ {{ ($carItems) ? number_format($carItems['cart_subtotal'], 2, ',', '.'): '' }}</p>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <p>Frete</p>
                                <p>R$ {{ ($carItems) ? number_format($carItems['freight'], 2, ',', '') : '' }}</p>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <p>Desconto</p>
                                <div>
                                    <input class="form-control" type="text" name="coupon" id="coupon">
                                    <input type="hidden" name="coupon_id" id="coupon_id">
                                    <small id="coupon_message" style="color: red;"></small>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <p>Total</p>
                                <input type="hidden" name="total"  id="cart-total"  value="{{ ($carItems) ? number_format( ($carItems['cart_subtotal'] + $carItems['freight']), 2, ',','.' ) : '' }}">

                                <p id="total">{{ ($carItems) ? number_format( ($carItems['cart_subtotal'] + $carItems['freight']), 2, ',','.' ) : '' }}</p>
                            </div>
                        </div>
                        <div class="row d-flex flex-column gap-2 mt-3">
                            <div class="d-grid">
                                <button type="submit" class="btn btn-green">Finalizar compra</button>
                            </div>
                            <div class="d-grid">
                                <a href="{{ route('stores.index') }}" class="btn btn-pink">Continuar comprando</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function(){
            const cuponInput = document.querySelector('#coupon');
            const couponMessage = document.getElementById('coupon_message');
            const totalElement = document.getElementById('total');
            const totalInput = document.getElementById('cart-total');
            const cart = @json($carItems);

            let total = (cart && cart.cart_subtotal !== undefined && cart.freight !== undefined)
                ? parseFloat(cart.cart_subtotal) + parseFloat(cart.freight)
                : '';

            cuponInput.addEventListener('blur', function(){
                const code = cuponInput.value.trim();
                if (code.length === 0) {

                    couponMessage.textContent = '';
                    totalElement.textContent = `R$ ${total.toFixed(2)}`;
                    totalInput.value = total.toFixed(2);
                    return;
                }

                const query = new URLSearchParams({
                    code: code,
                    subtotal: cart.cart_subtotal
                }).toString();

                fetch('/validate-coupon?'+ query +'', {
                    method: 'GET',
                })
                    .then(response => response.json())
                    .then(data => {
                        if (!data.valid) {
                            couponMessage.textContent = data.message;

                        } else {
                            totalElement.textContent = '';
                            totalInput.value = '';
                            couponMessage.style.color = 'green';
                            couponMessage.textContent = `Cupom válido! Desconto de R$ ${parseFloat(data.discount).toFixed(2)}`;
                            const newTotal = total - parseFloat(data.discount);
                            totalElement.textContent = `R$ ${newTotal.toFixed(2)}`;
                            totalInput.value = newTotal.toFixed(2);
                            document.getElementById('coupon_id').value = data.id;
                        }
                    })
                    .catch((error)=>{
                        console.log(error.message);
                        couponMessage.style.color = 'red';
                        couponMessage.textContent = 'Erro ao validar cupom';
                    })

            });

            const cepInput = document.querySelector('#cep');
            const cepMessage = document.getElementById('cep-message');

            cepInput.addEventListener('blur', function(){
                const cepStr = cepInput.value.trim();
                const cep = cepStr.replace(/\D/g, '');

                fetch('https://viacep.com.br/ws/' + cep + '/json', {
                    method: 'GET',
                })
                .then(response => response.json())
                .then(data => {
                   document.getElementById('logradouro').value = data.logradouro;
                   document.getElementById('bairro').value = data.bairro;
                   document.getElementById('cidade').value = data.localidade;
                   document.getElementById('estado').value = data.estado;
                })
                .catch(()=>{
                    cepMessage.textContent = 'CEP inválido';
                })
            })


        })
    </script>
@endsection
