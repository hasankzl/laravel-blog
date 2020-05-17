<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class avenueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data=['belirtilmedi','cadde2','cadde3','cadde4','cadde5','cadde6'];
        foreach ($data as $name) {
            DB::table('avenues')->insert([
      'name'=>$name,
      'slug'=>Str::slug($name),
      'neighborhood_id'=>rand(1, 4),
      'created_at'=>now(),
      'updated_at'=>now(),
    ]);
        }
    }
}
