<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class centurySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names=['belirtilmedi','2 YY','3 YY','4 YY','5 YY','6 YY'];
        foreach ($names as $name) {
            DB::table('centuries')->insert([
  'name'=>$name,
  'slug'=>Str::slug($name),
  'created_at'=>now(),
  'updated_at'=>now()
]);
        }
    }
}
