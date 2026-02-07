<?php

namespace App\Console\Commands;

use App\Models\Procedure;
use App\Models\ProcedurePrice;
use App\Services\RsApiService;
use Illuminate\Console\Command;

class SyncProcedurePrices extends Command
{
    protected $signature = 'sync:procedure-prices';

    public function handle(RsApiService $api)
    {
        $procedures = Procedure::all();
        // dd($procedures);
        foreach ($procedures as $procedure) {
            // dd($procedure->id);
            $prices = $api->getProcedurePrices($procedure->id);

            foreach ($prices['prices'] as $price) {
                // dd($price['start_date']['value']);
                ProcedurePrice::updateOrCreate(
                    [
                        'id' => $price['id'],
                        'procedure_id' => $procedure->id,
                        'price' => $price['unit_price'],
                        'start_date' => $price['start_date']['value'],
                        'end_date' => $price['end_date']['value'],
                    ],
                    []
                );
            }
        }
    }
}
