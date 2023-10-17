<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Orders;

class CreateOrdersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $orders = [
            ['product_id' => 1, 'quantity' => 10, 'created_at' => '2021-05-01'],
            ['product_id' => 2,'quantity' => 19, 'created_at' => '2021-05-05'],
            ['product_id' => 1, 'quantity' => 15, 'created_at' => '2021-05-10'],
            ['product_id' => 3, 'quantity' => 20, 'created_at' => '2021-05-11'],
            ['product_id' => 4, 'quantity' => 30, 'created_at' => '2021-05-11'],
            ['product_id' => 5, 'quantity' => 25, 'created_at' => '2021-05-12'],
            ['product_id' => 2, 'quantity' => 5, 'created_at' => '2021-05-12'],
        ];

        foreach($orders as $order){
            Orders::create($order);
        }
    }
}
