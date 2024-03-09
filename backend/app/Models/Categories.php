<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'image'
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
