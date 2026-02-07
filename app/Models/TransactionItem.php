<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionItem extends Model
{
    protected $table = 'transaction_items';

    protected $fillable = [
        'transaction_id',
        'procedure_id',
        'procedure_name',
        'price',
        'total',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'total' => 'decimal:2',
    ];

    /* ================= RELATIONS ================= */

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

    public function procedure()
    {
        return $this->belongsTo(Procedure::class);
    }
}
