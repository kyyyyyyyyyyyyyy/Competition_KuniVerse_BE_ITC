<?php

namespace Modules\ProductCateory\Console\Commands;

use Illuminate\Console\Command;

class ProductCateoryCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:ProductCateoryCommand';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'ProductCateory Command description';

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
