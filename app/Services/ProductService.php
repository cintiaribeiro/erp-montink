<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Facades\DB;

class ProductService
{
    public function __construct(
        private Product $product,
        private StockService $stockService,
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
        $stock = array_filter($request->stock, function ($stockItem) {
            return !empty($stockItem['variation']) && !empty($stockItem['amount']);
        });

        try{
            DB::beginTransaction();
            $product = $this->product->create($data);
            $this->stockService->storeStock($stock, $product);
            DB::commit();
            return redirect()->route('products.index')->with('success', 'Produto criado com sucesso!');
        }catch (\Exception $e){
            DB::rollBack();
            return redirect()->route('products.index')->with('error', 'Erro ao criar produto!' . $e->getMessage());
        }
    }

    public function showProduct($product)
    {
        return view('products.show', compact('product'));
    }

    public function editProduct($product)
    {
        return view('products.edit', compact('product'));
    }

    public function updateProduct($request, $product)
    {
        $data = $request->all();
        $stock = array_filter($request->stock, function ($stockItem) {
            return !empty($stockItem['variation']) && !empty($stockItem['amount']);
        });
        try{
            DB::beginTransaction();
                $product->update($data);
                $this->stockService->updateStock($stock, $product);
            DB::commit();
            return redirect()->route('products.index')->with('success', 'Produto atualizado com sucesso!');
        }catch (\Exception $e){
            DB::rollBack();
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
