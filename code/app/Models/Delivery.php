<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    use HasFactory;

    public function courier()
    {
        return $this->belongsTo(Courier::class);
    }

    public function deliveryStatus()
    {
        return $this->belongsTo(DeliveryStatus::class);
    }

    public function deliveryType()
    {
        return $this->belongsTo(DeliveryType::class);
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    protected $casts = [
        'delivery_date' => 'datetime',
    ];

    protected $fillable = [
        'courier_id', 
        'delivery_date', 
        'delivery_status_id', 
        'delivery_type_id'
    ];
}
