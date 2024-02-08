<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restriction extends Model
{
    use HasFactory;

    protected $primaryKey = 'price_id';

    public $incrementing = false;

    protected $fillable = [
        'price_id',
        'installment_id',
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
        return $this->belongsTo(Price::class);
    }

    public function installment()
    {
        return $this->belongsTo(Installment::class, 'installment_id');
    }
}
