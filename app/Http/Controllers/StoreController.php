<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\StoreService;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function __construct(
        private StoreService $storeService
    ){}

    public function index()
    {
        return $this->storeService->index();
    }

    public function show(Product $product)
    {
        return $this->storeService->details($product);
    }
}
