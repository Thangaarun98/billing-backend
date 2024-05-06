<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillingDetails extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'product_details',
        'denomination',
        'balance_denomination',
        'total_price',
        'cash_paid',
        'total_amount',
        'total_tax',
        'balance_amount'
    ];
}
