<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class padisahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names=['belirtilmedi','1.Mehmed','Yavuz Sultan Selim','Kanuni'];
        foreach ($names as $name) {
            DB::table('padisahs')->insert([
    'name'=>$name,
    'slug'=>Str::slug($name),
    'created_at'=>now(),
    'updated_at'=>now()
  ]);
        }
    }
}
