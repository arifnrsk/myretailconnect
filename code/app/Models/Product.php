<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function transactionDetails()
    {
        return $this->hasMany(TransactionDetail::class);
    }

    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }

    protected $casts = [
        'scheduled_date' => 'datetime',
    ];

    protected $fillable = [
        'name',
        'description',
        'price',
        'unit_id',
        'category_id',
        'stock'
    ];
}
