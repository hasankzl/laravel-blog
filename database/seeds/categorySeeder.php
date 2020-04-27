<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class categorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories=['Camiler','Kervansaraylar','Mektepler','Mekanlar','Salonlar'];
        $faker=Faker::create();
        foreach ($categories as $cat) {
            DB::table('categories')->insert([
          'name'=>$cat,
                'image'=>$faker->imageUrl('800', '400', 'cats', true, 'faker'),
          'slug'=>Str::slug($cat)
        ]);
        }
    }
}
