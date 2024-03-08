<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brands extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];
    public function items()
    {
        return $this->hasMany(Product::class);
    }
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
