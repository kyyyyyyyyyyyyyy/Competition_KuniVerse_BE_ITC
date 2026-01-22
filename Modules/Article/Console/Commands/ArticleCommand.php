<?php

namespace Modules\Article\Console\Commands;

use Illuminate\Console\Command;

class ArticleCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:ArticleCommand';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Article Command description';

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
