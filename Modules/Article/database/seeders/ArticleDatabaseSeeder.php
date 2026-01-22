<?php

namespace Modules\Article\database\seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\Article\Models\Article;

class ArticleDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Disable foreign key checks!
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        /*
         * Articles Seed
         * ------------------
         */

        // DB::table('articles')->truncate();
        // echo "Truncate: articles \n";

        Article::factory()->count(20)->create();
        $rows = Article::all();
        echo " Insert: articles \n\n";

        // Enable foreign key checks!
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
