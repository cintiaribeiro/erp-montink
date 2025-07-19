<?php

namespace App\Services;

use App\Models\Product;

class ProductService
{
    public function __construct(
        private Product $product,
    ){}
    public function allProduct()
    {
        $products = $this->product->all();
        return view('products.index', compact('products'));
    }

    public function createProduct()
    {
        return view('products.create');
    }

    public function storeProduct($request)
    {
        $data = $request->all();
        try{
            $this->product->create($data);
            return redirect()->route('products.index')->with('success', 'Produto criado com sucesso!');

        }catch (\Exception $e){
            return redirect()->route('products.index')->with('error', 'Erro ao criar produto!' . $e->getMessage());
        }
    }

    public function editProduct($product)
    {
        return view('products.edit', compact('product'));
    }

    public function updateProduct($request, $product)
    {
        $data = $request->all();
        try{
            $product->update($data);;
            return redirect()->route('products.index')->with('success', 'Produto atualizado com sucesso!');
        }catch (\Exception $e){
            return redirect()->route('products.index')->with('error', 'Erro ao atualizar produto!' . $e->getMessage());
        }
    }

    public function destroyProduct($product)
    {
        try{
            $product->delete();
            return redirect()->route('products.index')->with('success', 'Produto deletado com sucesso!');
        }catch (\Exception $e){
            return redirect()->route('products.index')->with('error', 'Erro ao deletar produto!' . $e->getMessage());
        }
    }
}
