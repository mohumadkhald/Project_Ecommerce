<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', // Foreign key to link to the User model
        'image',    // Image path or URL
        'description',
        'title',
        'quantity',
        'price',
        'hidden'
    ];

    // Define a relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Define a relationship with the ExchangeRequest model
    public function exchangeRequests()
    {
        return $this->hasMany(ExchangeRequest::class);
    }
}
