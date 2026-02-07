<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    protected $table = 'vouchers';

    protected $fillable = [
        'insurance_id',
        'discount_type',
        'discount_value',
        'max_discount',
        'start_date',
        'end_date',
    ];

    public function insurances()
    {
        return $this->belongsTo(Insurance::class, 'insurance_id');
    }

    public function scopeActive(Builder $query, $date = null)
    {
        $date = $date ?? now()->toDateString();

        return $query->where('start_date', '<=', $date)
            ->where(function ($q) use ($date) {
                $q->whereNull('end_date')
                    ->orWhere('end_date', '>=', $date);
            });
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
    
}
