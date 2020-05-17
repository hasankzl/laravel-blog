<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class articleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker=Faker::create();
        for ($i=0; $i < 4; $i++) {
            $title=$faker->sentence(6);
            DB::table("articles")->insert([
            'title'=>$title,
            'category_id'=>rand(1, 5),
            'maker_id'=>rand(1, 4),
            'city_id'=>rand(1, 5),
            'architect_id'=>rand(1, 4),
            'padisah_id'=>rand(1, 4),
            'seyhulislam_id'=>rand(1, 4),
            'century_id'=>rand(1, 4),
            'country_id'=>rand(1, 4),
            'semt_id'=>rand(1, 4),
            'neighborhood_id'=>rand(1, 4),
            'avenue_id'=>rand(1, 4),
            'street_id'=>rand(1, 4),
            'district_id'=>rand(1, 4),
            'village_id'=>rand(1, 4),
            'status_id'=>rand(1, 4),
            'year'=>"1995",
            'fullAddress'=>"tam adres",
            'image'=>$faker->imageUrl('800', '400', 'cats', true, 'faker'),
            'content'=>$faker->paragraph(6),
            'slug'=>Str::slug($title),
            'created_at'=>$faker->dateTime('now'),
            'updated_at'=>now()
          ]);
        }
    }
}
