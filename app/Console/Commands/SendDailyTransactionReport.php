<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Transaction;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DailyTransactionExport;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class SendDailyTransactionReport extends Command
{
    protected $signature = 'report:daily-transaction';
    protected $description = 'Send yesterday transaction report (Excel)';

    public function handle()
    {
        $date = Carbon::yesterday('Asia/Jakarta');

        $filename = 'laporan-transaksi-' . $date->format('Y-m-d') . '.xlsx';

        Excel::store(new DailyTransactionExport($date), $filename);

        $path = Storage::disk('local')->path($filename);

        if (!file_exists($path)) {
            throw new \Exception('File laporan tidak ditemukan' . $path);
        }

        Mail::raw(
            "Terlampir laporan transaksi tanggal {$date->format('d-m-Y')}",
            function ($message) use ($path, $filename) {
                $message->to('interview.deltasurya@yopmail.com')
                    ->subject('Laporan Transaksi Harian')
                    ->attach($path);
            }
        );
    }
}
