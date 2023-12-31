<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    protected $casts = [
        'review_date' => 'datetime',
    ];

    protected $fillable = [
        'product_id', 
        'customer_id', 
        'ratings', 
        'comment', 
        'review_date'
    ];
}
