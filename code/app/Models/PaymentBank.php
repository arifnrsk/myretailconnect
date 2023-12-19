<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentBank extends Model
{
    use HasFactory;

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }

    public function bankName()
    {
        return $this->belongsTo(BankName::class, 'bank_name_id');
    }

    protected $fillable = [
        'payment_id',
        'account_name', 
        'account_number', 
        'bank_name_id'
    ];
}
