<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Products;

class CreateProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            ['product_name' => 'Kopi', 'product_type' => 'Konsumsi', 'stock' => 90],
            ['product_name' => "Teh",'product_type' => 'Konsumsi', 'stock' => 81],
            ['product_name' => "Pasta Gigi", 'product_type' => 'Pembersih', 'stock' => 80],
            ['product_name' => "Sabun Mandi", 'product_type' => 'Pembersih', 'stock' => 70],
            ['product_name' => "Sampo", 'product_type' => 'Pembersih', 'stock' => 75]
        ];

        foreach($products as $product){
            Products::create($product);
        }
    }
}
