<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class makerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names=['belirtilmedi','Yavuz Sultan Selim','Fatih','Osman Bey'];
        foreach ($names as $name) {
            DB::table('makers')->insert([
        'name'=>$name,
        'slug'=>Str::slug($name),
        'created_at'=>now(),
        'updated_at'=>now()
      ]);
        }
    }
}
