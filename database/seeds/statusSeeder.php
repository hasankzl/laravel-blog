<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class statusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names=['belirtilmedi','Yıkık','İbadete Açık','İbadete Kapalı'];
        foreach ($names as $name) {
            DB::table('statuses')->insert([
'name'=>$name,
'slug'=>Str::slug($name),
'created_at'=>now(),
'updated_at'=>now()
]);
        }
    }
}
