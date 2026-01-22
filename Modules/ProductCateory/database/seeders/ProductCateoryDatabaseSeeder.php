<?php

namespace Modules\ProductCateory\database\seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\ProductCateory\Models\ProductCateory;

class ProductCateoryDatabaseSeeder extends Seeder
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
         * ProductCateories Seed
         * ------------------
         */

        // DB::table('productcateories')->truncate();
        // echo "Truncate: productcateories \n";

        ProductCateory::factory()->count(20)->create();
        $rows = ProductCateory::all();
        echo " Insert: productcateories \n\n";

        // Enable foreign key checks!
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
