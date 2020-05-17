<?php

use Illuminate\Database\Seeder;

class architectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names=['belirtilmedi','Mimar Ali','Mimar Hasan','Mimar Halil','Mimar kim'];
        foreach ($names as $name) {
            DB::table('architects')->insert([
    'name'=>$name,
    'slug'=>Str::slug($name),
    'created_at'=>now(),
    'updated_at'=>now()
  ]);
        }
    }
}
