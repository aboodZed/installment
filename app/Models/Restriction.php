<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restriction extends Model
{
    use HasFactory;

    protected $primaryKey = 'price_id';

    protected $fillable = [
        'price_id',
        'customer_id',
        'desc',
        'is_credit',
        'paid',
        'pay_date',
    ];

    protected $casts = [
        'is_credit' => 'boolean',
        'paid' => 'boolean',
        'pay_date' => 'date',
    ];

    public function price()
    {
        return $this->belongsTo(Price::class, 'price_id');
    }

    public function user()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
}
