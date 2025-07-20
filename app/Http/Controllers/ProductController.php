<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct(
        private ProductService $productService,
    )
    {}
    public function index()
    {
       return $this->productService->allProduct();
    }

    public function create()
    {
        return $this->productService->createProduct();
    }

    public function store(Request $request)
    {
        return $this->productService->storeProduct($request);
    }

    public function show(Product $product)
    {
        return $this->productService->showProduct($product);
    }

    public function edit(Product $product)
    {
        return $this->productService->editProduct($product);
    }

    public function update(Request $request, Product $product)
    {
        return $this->productService->updateProduct($request, $product);
    }

    public function destroy(Product $product)
    {
        return $this->productService->destroyProduct($product);
    }
}
