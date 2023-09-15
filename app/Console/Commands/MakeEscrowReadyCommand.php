<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Marketplace\xmrEscrow;

class MakeEscrowReadyCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:escrow-ready';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command will create Escrow and Commissions Wallet';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $escrow = new xmrEscrow();
        $escrow->makeEscReady();

        $this->info('Application is ready!');

        // Everything went well, return 0
        return 0;
    }
}
