<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\RsApiService;
use App\Models\Insurance;

class SyncInsurances extends Command
{
    protected $signature = 'sync:insurances';
    protected $description = 'Sync insurance data from RS API';

    public function handle(RsApiService $api)
    {
        $data = $api->getInsurances();
        
        foreach ($data['insurances'] as $insurance) {
            Insurance::updateOrCreate(
                ['id' => $insurance['id']],
                ['name' => $insurance['name']]
            );
        }

        $this->info('Insurance data synced successfully');
    }
}
