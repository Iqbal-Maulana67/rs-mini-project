<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionReport extends Model
{
    protected $table = 'transaction_reports';

    protected $fillable = [
        'report_date',
        'sent_to',
        'file_path',
        'sent_at',
    ];

    protected $casts = [
        'report_date' => 'date',
        'sent_at' => 'datetime',
    ];
}
