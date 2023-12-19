<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
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

    public function transactionStatus()
    {
        return $this->belongsTo(TransactionStatus::class);
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }

    public function transactionDetails()
    {
        return $this->hasMany(TransactionDetail::class);
    }

    public function returnsAndRefunds()
    {
        return $this->hasMany(ReturnAndRefund::class);
    }

    protected $casts = [
        'transaction_date' => 'datetime',
    ];

    public function invoice()
    {
        return $this->hasOne(Invoice::class);
    }

    protected $fillable = [
        'customer_id', 
        'transaction_date', 
        'transaction_status_id',
        'total_amount', 
        'delivery_id', 
        'payment_id'
    ];
}