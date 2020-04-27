<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class addressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i <5 ; $i++) {
            DB::table('addresses')->insert([
       'city_id'=>rand(1, 5),
       'fullAddress'=>"Tam adresi",
       'created_at'=>now(),
       'updated_at'=>now()
     ]);
        }
    }
}
