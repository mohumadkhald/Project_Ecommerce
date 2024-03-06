<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;
    protected $fillable = ['buyer_id', 'state'];

    public function purchasedProducts()
{
    return $this->hasMany(PurchasedProduct::class, 'purchase_id');
}

public function user()
    {
        return $this->belongsTo(User::class);
    }

}
