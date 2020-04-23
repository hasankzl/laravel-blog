<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("admins")->insert([
          'name'=>"Hasan Kuzulu",
          'email'=>"mhasan.kzl@gmail.com",
          'password'=>bcrypt(102030),
           
        ]);
    }
}
