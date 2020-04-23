<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class categorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories=['Genel','Eğlence','Bilişim','Gezi','Teknoloji','Sağlık','Spor','Günlük Yaşam'];

        foreach ($categories as $cat) {
            DB::table('categories')->insert([
          'name'=>$cat,
          'slug'=>Str::slug($cat)
        ]);
        }
    }
}
