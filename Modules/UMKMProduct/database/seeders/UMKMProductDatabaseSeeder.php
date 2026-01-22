<?php

namespace Modules\UMKMProduct\database\seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\UMKMProduct\Models\UMKMProduct;

class UMKMProductDatabaseSeeder extends Seeder
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
         * UMKMProducts Seed
         * ------------------
         */

        // DB::table('umkmproducts')->truncate();
        // echo "Truncate: umkmproducts \n";

        UMKMProduct::factory()->count(20)->create();
        $rows = UMKMProduct::all();
        echo " Insert: umkmproducts \n\n";

        // Enable foreign key checks!
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
