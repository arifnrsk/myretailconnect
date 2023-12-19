<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Customer extends Authenticatable
{
    use HasFactory;
    use Notifiable;

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }

    protected $casts = [
        'birth_date' => 'datetime',
    ];

    protected $fillable = [
        'name',
        'birth_date',
        'address',
        'email',
        'password',
        'gender',
        'phone_number',
        'profile_picture_path',
    ];
}
