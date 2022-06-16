<?php

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
class Users extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (DB::table('users')->get()->count() == 0) {
            $data = [
                ['userid' => '1', 'username' => 'Admin', 'password' => bcrypt('phoenix17')],
                ['userid' => '2', 'username' => 'Dharmendra', 'password' => bcrypt('moni')],
                ['userid' => '3', 'username' => 'Others', 'password' => bcrypt('123456')],
                ['userid' => '4', 'username' => 'Janu', 'password' => bcrypt('17optimum')],
                ['userid' => '5', 'username' => 'Anjeela', 'password' => bcrypt('liza')],
                ['userid' => '6', 'username' => 'Bhaskar', 'password' => bcrypt('9707737232')],
                ['userid' => '7', 'username' => 'Nabajyoti', 'password' => bcrypt('ghy21')],
                ['userid' => '7', 'username' => 'Arjun', 'password' => bcrypt('1126')],
                ['userid' => '8', 'username' => 'Amar', 'password' => bcrypt('ghy21')],
                ['userid' => '9', 'username' => 'PChelleng', 'password' => bcrypt('123456')],
                ['userid' => '10', 'username' => 'Ritu', 'password' => bcrypt('123456')],
                ['userid' => '11', 'username' => 'Manoj', 'password' => bcrypt('12345')],
                ['userid' => '12', 'username' => 'Archana', 'password' => bcrypt('123456')],
                ['userid' => '13', 'username' => 'Proloy', 'password' => bcrypt('123456')],
                ['userid' => '14', 'username' => 'Shaukat', 'password' => bcrypt('123456')],

            ];

            DB::table('users')->insert($data);
        }
    }
}
