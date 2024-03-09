<?php

namespace App\Console\Commands;

use Algolia\ScoutExtended\Facades\Algolia;
use Illuminate\Console\Command;

class ScoutPostSync extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scout:post-sync';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creating replicas for custom ranking';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $indexes = config('scout-replicas');
        $client = Algolia::client();

        foreach ($indexes as $indexKey => $replicas) {
            foreach ($replicas as $replicaKey => $replicaConfig) {
                $replica = $client->initIndex($replicaKey);
                $replica->setSettings($replicaConfig);
            }
        }
    }
}
