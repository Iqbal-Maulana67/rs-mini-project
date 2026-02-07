<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class ProcedurePrice extends Model
{
    protected $table = 'procedure_prices';

    public $incrementing = false;

    protected $keyType = 'string';
    
    protected $fillable = [
        'id',
        'procedure_id',
        'price',
        'start_date',
        'end_date'
    ];

    /**
     * Relasi: Harga milik satu Procedure
     */
    public function procedure()
    {
        return $this->belongsTo(Procedure::class, 'procedure_id');
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
}
