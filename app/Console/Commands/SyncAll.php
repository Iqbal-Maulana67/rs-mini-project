<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SyncAll extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:all';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting sync all...');

        $this->call('sync:insurances');
        $this->call('sync:procedures');
        $this->call('sync:procedure-prices');

        $this->info('All sync completed ✅');
    }
}
