<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $table = 'order_items';

    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'price',
    ];

    /**
     * Relationships
     */

    // OrderItem belongs to an order
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // OrderItem belongs to a product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
