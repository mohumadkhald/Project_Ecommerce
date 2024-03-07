<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddedToCartProduct extends Model
{
    use HasFactory;

    protected $table = 'added_to_cart_products';

    protected $fillable = [
        'product_id',
        'buyer_id',
        'quantity',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
