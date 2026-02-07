<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transactions';

    protected $fillable = [
        'transaction_number',
        'insurance_id',
        'cashier_id',
        'patient_name',
        'subtotal',
        'discount',
        'total',
    ];

    protected $casts = [
        'subtotal' => 'decimal:2',
        'discount' => 'decimal:2',
        'total' => 'decimal:2',
    ];

    public function items()
    {
        return $this->hasMany(TransactionItem::class);
    }

    public function insurance()
    {
        return $this->belongsTo(Insurance::class);
    }

    public function cashier()
    {
        return $this->belongsTo(User::class, 'cashier_id');
    }
}
