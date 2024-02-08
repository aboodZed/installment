<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $primaryKey = 'user_id';

    protected $fillable = [
        'user_id',
        'address',
        'currency_code',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function restrictions()
    {
        return $this->hasManyThrough(Restriction::class, Installment::class, 'customer_id');
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class, 'currency_code', 'code');
    }
}
