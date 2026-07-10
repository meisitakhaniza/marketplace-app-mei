<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'seller_id',
        'category'
    ];

    // Relasi ke user (penjual)
    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }

    // Relasi ke varian produk (satu produk punya banyak varian)
    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }

    // Relasi ke foto produk
    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }
}