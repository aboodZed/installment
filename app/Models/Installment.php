<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Installment extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'desc',
    ];

    public function restrictions()
    {
        return $this->hasMany(Restriction::class);
    }

    public function user()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
}
