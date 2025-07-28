<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'quantity',
    ];

    // 📦 Each cart item belongs to a product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // 👤 Each cart belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
