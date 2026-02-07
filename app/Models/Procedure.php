<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Procedure extends Model
{
    protected $table = 'procedures';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'name',
    ];

    public function prices()
    {
        return $this->hasMany(ProcedurePrice::class, 'procedure_id');
    }

    public function activePrices()
    {
        return $this->hasMany(ProcedurePrice::class)->active();
    }

    public function transactionItems()
    {
        return $this->hasMany(TransactionItem::class);
    }
}
