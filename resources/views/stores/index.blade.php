
@extends('layouts.app')

@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-5">Produtos</h5>
                <div class="row mb-4">
                    @foreach($products as $product)
                    <div class="col-md-3">
                        <a href="{{ route('stores.show', $product->uuid) }}" class="text-decoration-none text-dark">
                            <div class="text-center">
                                <img src="https://placehold.co/290X290/e2e0e0/FFFFFF/png" alt="">
                            </div>
                            <div class="p-2">
                                <p class="mb-0"><Strong>{{ $product->name }}</Strong></p>
                                <p><strong>{{ $product->price }}</strong></p>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
