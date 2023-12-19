<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Courier extends Model
{
    use HasFactory;

    public function deliveries()
    {
        return $this->hasMany(Delivery::class);
    }

    protected $fillable = [
        'name', 
        'birth_date', 
        'address', 
        'phone_number'
    ];
}
