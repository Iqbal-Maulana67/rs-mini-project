<?php

namespace App\Console\Commands;

use App\Models\Procedure;
use App\Services\RsApiService;
use Illuminate\Console\Command;

class SyncProcedures extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:procedures';
    
    /**
     * Execute the console command.
     */
    public function handle(RsApiService $api)
    {
        $data = $api->getProcedures();

        foreach ($data['procedures'] as $proc) {
            Procedure::updateOrCreate(
                ['id' => $proc['id']],
                ['name' => $proc['name']]
            );
        }
    }
}
