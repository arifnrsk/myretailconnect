<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankName extends Model
{
    use HasFactory;

    public function payment_banks()
    {
        return $this->hasMany(PaymentBank::class);
    }
}
