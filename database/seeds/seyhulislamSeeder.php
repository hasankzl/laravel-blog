<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class seyhulislamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names=['belirtilmedi','Molla Fahrettin Acemi','Molla Gürâni','Zenbilli Ali Efendi'];
        foreach ($names as $name) {
            DB::table('seyhulislams')->insert([
  'name'=>$name,
  'slug'=>Str::slug($name),
  'created_at'=>now(),
  'updated_at'=>now()
]);
        }
    }
}
