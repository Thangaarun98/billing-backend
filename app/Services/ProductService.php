<?php

namespace App\Services;

use App\Models\Product;

class ProductService
{

    public static function getProducts()
    {
        return Product::where('status', 1)->get();
    }

    public static function createOrUpdate($data)
    {
        return Product::updateOrCreate(
            ['product_id' => $data['product_id']],
            [
                'name' => $data['name'],
                'status' => $data['status'],
                'price' => $data['price'],
                'tax' => $data['tax']
            ]
        );
    }

}
