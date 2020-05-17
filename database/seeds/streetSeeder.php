<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class streetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data=['belirtilmedi','sokak2','sokak3','sokak4','sokak5','sokak6'];
        foreach ($data as $name) {
            DB::table('streets')->insert([
      'name'=>$name,
      'slug'=>Str::slug($name),
      'avenue_id'=>rand(1, 4),
      'created_at'=>now(),
      'updated_at'=>now(),
    ]);
        }
    }
}
