<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class semtSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data=['belirtilmedi','Beyoğlu','Kadıköy','Fatih','Karaköy','Eminonü'];
        foreach ($data as $name) {
            DB::table('semts')->insert([
      'name'=>$name,
      'slug'=>Str::slug($name),
      'city_id'=>rand(1, 4),
      'created_at'=>now(),
      'updated_at'=>now(),
    ]);
        }
    }
}
