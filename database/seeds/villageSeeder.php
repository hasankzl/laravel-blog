<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class villageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data=['belirtilmedi','köy2','köy3','köy4','köy5'];
        foreach ($data as $name) {
            DB::table('villages')->insert([
      'name'=>$name,
      'slug'=>Str::slug($name),
      'district_id'=>rand(1, 4),
      'created_at'=>now(),
      'updated_at'=>now(),
    ]);
        }
    }
}
