<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class citySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cities=['İstanbul','Ankara','İzmir','Bursa','Sakarya','Yalova'];
        foreach ($cities as $city) {
            DB::table('cities')->insert([
      'name'=>$city,
      'slug'=>Str::slug($city),
      'created_at'=>now(),
      'updated_at'=>now(),
    ]);
        }
    }
}
