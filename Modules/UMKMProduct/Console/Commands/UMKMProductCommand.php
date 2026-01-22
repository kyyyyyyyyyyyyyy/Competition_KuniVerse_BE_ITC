<?php

namespace Modules\UMKMProduct\Console\Commands;

use Illuminate\Console\Command;

class UMKMProductCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:UMKMProductCommand';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'UMKMProduct Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        return Command::SUCCESS;
    }
}
