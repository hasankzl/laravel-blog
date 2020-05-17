<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class neighborhoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data=['belirtilmedi','mahalle2','mahalle3','mahalle4','mahalle5','mahalle6'];
        foreach ($data as $name) {
            DB::table('neighborhoods')->insert([
      'name'=>$name,
      'slug'=>Str::slug($name),
      'district_id'=>rand(1, 4),
      'created_at'=>now(),
      'updated_at'=>now(),
    ]);
        }
    }
}
