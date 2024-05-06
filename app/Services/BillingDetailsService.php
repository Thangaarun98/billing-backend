<?php

namespace App\Services;

use App\Models\BillingDetails;
use App\Models\Product;
use Illuminate\Support\Arr;

class BillingDetailsService
{

    public static function createOrUpdate($data)
    {
        // denominations amounts set
        $denominations = [
            '500' => Arr::get($data,'denominations.500', NULL),
            '100' => Arr::get($data,'denominations.100', NULL),
            '50' => Arr::get($data,'denominations.50', NULL),
            '20' => Arr::get($data,'denominations.20', NULL),
            '10' => Arr::get($data,'denominations.10', NULL),
            '5' => Arr::get($data,'denominations.5', NULL),
            '2' => Arr::get($data,'denominations.2', NULL),
            '1' => Arr::get($data,'denominations.1', NULL)
        ];

        // product details set
        $items = $data['items'];
        $totalTax = 0;
        $totalAmountWithTax = 0;
        foreach ($items as $key => $item) {
            $product = Product::where('product_id', $item['productId'])->first();
            $tax = ($product->tax / 100) * $item['price'];
            $items[$key]['taxPer'] = $product->tax;
            $items[$key]['tax']  = $tax;
            $items[$key]['total']  = $item['price'] + $tax;
            $items[$key]['price'] = $product->price;
            $totalTax += $tax;
            $totalAmountWithTax += $items[$key]['total'];
        }

        // balance denominations amounts set
        $balance = $data['paidPayment'] - $totalAmountWithTax;
        $values = [500, 100, 50, 20, 10, 5, 2, 1];
        $distribution = [];

        foreach ($values as $denomination) {
            $bills = intval($balance / $denomination); // Number of bills of current denomination
            $distribution[$denomination] = $bills; // Store the number of bills in the distribution array
            $balance -= $bills * $denomination; // Update the balance amount
        }

        // billing details insert
        return BillingDetails::updateOrCreate(
            [
                'email' => $data['userEmail'],
                'total_price' => $data['totalAmount'],
                'cash_paid' => $data['paidPayment'],
                'total_tax' => $totalTax,
                'total_amount' => $totalAmountWithTax,
                'product_details' => serialize($items),
                'denomination' => serialize($denominations),
                'balance_denomination' => serialize($distribution),
                'balance_amount' => $data['paidPayment'] - $totalAmountWithTax
            ]
        );
    }

    public static function getBillingDetails($id) {
        $billingDetail = BillingDetails::find($id);
        $billingDetail->product_details = unserialize($billingDetail->product_details);
        $billingDetail->denomination = unserialize($billingDetail->denomination);
        $billingDetail->balance_denomination = unserialize($billingDetail->balance_denomination);
        return $billingDetail;
    }

}
