<?php

namespace App\Exports;

use App\Models\Transaction;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DailyTransactionExport implements FromCollection, WithHeadings
{
    protected $date;

    public function __construct(Carbon $date)
    {
        $this->date = $date;
    }

    public function collection()
    {
        return Transaction::whereDate(
            'created_at',
            $this->date->toDateString()
        )->get([
            'transaction_number',
            'patient_name',
            'subtotal',
            'discount',
            'total',
            'created_at'
        ]);
    }

    public function headings(): array
    {
        return [
            'No Transaksi',
            'Nama Pasien',
            'Subtotal',
            'Diskon',
            'Total',
            'Tanggal'
        ];
    }
}
