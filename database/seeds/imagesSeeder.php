<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class imagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names=['Osman Bey','1.Mehmed','Yavuz Sultan Selim','Kanuni'];
        foreach ($names as $name) {
            DB::table('images')->insert([
            'name'=>$name,
            'size'=>100,
            'article_id'=>1,
            'created_at'=>now(),
            'updated_at'=>now(),
]);
        }
    }
}
