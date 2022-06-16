<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class financialyear extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('financialyears')->insert([
            'finyear' => '2020-21',
        ]);
    }
}
