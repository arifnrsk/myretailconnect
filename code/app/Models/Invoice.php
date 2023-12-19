<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function delivery()
    {
        return $this->belongsTo(Delivery::class);
    }

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

    protected $casts = [
        'invoice_date' => 'datetime',
    ];

    protected $fillable = [
        'customer_id', 
        'delivery_id', 
        'invoice_date', 
        'transaction_id'
    ];
}