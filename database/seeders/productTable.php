<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Database\Seeder;

class productTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            [
                'product_id' => 1,
                'name' => 'Product 1',
                'price' => 10.00,
                'tax' => 10,
                'status' => 1
            ],
            [
               'product_id' => 2,
                'name' => 'Product 2',
                'price' => 20.00,
                'tax' => 10,
                'status' => 1
            ],
            [
                'product_id' => 3,
                'name' => 'Product 3',
                'price' => 30.00,
                'tax' => 20,
                'status' => 1
            ],
            [
                'product_id' => 4,
                'name' => 'Product 4',
                'price' => 1500.00,
                'tax' => 20,
                'status' => 1
            ],
            [
                'product_id' => 5,
                'name' => 'Product 5',
                'price' => 5000.00,
                'tax' => 25,
                'status' => 1
            ],
            [
                'product_id' => 6,
                'name' => 'Product 6',
                'price' => 200.00,
                'tax' => 25,
                'status' => 1
            ],
            [
                'product_id' => 7,
                'name' => 'Product 7',
                'price' => 100.00,
                'tax' => 30,
                'status' => 1
            ],
            [
                'product_id' => 8,
                'name' => 'Product 8',
                'price' => 2000.00,
                'tax' => 30,
                'status' => 1
            ],
            [
                'product_id' => 9,
                'name' => 'Product 9',
                'price' => 20.00,
                'tax' => 33,
                'status' => 1
            ],
            [
                'product_id' => 10,
                'name' => 'Product 10',
                'price' => 35.00,
                'tax' => 33,
                'status' => 1
            ]
        ];

        // Insert the products into the database
        foreach ($products as $product) {
            ProductService::createOrUpdate($product);
        }
    }
}
