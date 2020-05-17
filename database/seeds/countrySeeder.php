<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class countrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $countries=['belirtilmedi','Irak','Suriye','Yunanistan','Fas','Mısır'];
        foreach ($countries as $country) {
            DB::table('countries')->insert([
    'name'=>$country,
    'slug'=>Str::slug($country),
    'created_at'=>now(),
    'updated_at'=>now(),
  ]);
        }
    }
}
