<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Stock;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Camisetas com variações: P, M, G
        $camisetas = [
            ['name' => 'Camiseta Básica', 'price' => 49.90],
            ['name' => 'Camiseta Estampada', 'price' => 59.90],
            ['name' => 'Camiseta Slim Fit', 'price' => 69.90],
        ];

        foreach ($camisetas as $camiseta) {
            $product = Product::create($camiseta);
            foreach (['P', 'M', 'G'] as $tamanho) {
                Stock::create([
                    'product_id' => $product->id,
                    'variation' => $tamanho,
                    'amount' => 20,
                ]);
            }
        }

        // Canecas com variações: Preta, Branca
        $canecas = [
            ['name' => 'Caneca Mágica', 'price' => 29.90],
            ['name' => 'Caneca Personalizada', 'price' => 34.90],
            ['name' => 'Caneca Clássica', 'price' => 24.90],
        ];

        foreach ($canecas as $caneca) {
            $product = Product::create($caneca);
            foreach (['Preta', 'Branca'] as $cor) {
                Stock::create([
                    'product_id' => $product->id,
                    'variation' => $cor,
                    'amount' => 15,
                ]);
            }
        }

    }
}
