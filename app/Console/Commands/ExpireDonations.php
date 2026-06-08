<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ExpireDonations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:expire-donations';

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
    Donasi::where('status', 'pending')
        ->where('expired_at', '<', now())
        ->update([
            'status' => 'expired'
        ]);
}
}
