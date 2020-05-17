<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $count=0;
        $pages=['Hakkımızda'];
        foreach ($pages as $page) {
            $count++;
            DB::table('pages')->insert([
  'title'=>$page,
  'slug'=>Str::slug($page),
  'created_at'=>now(),
  'image'=>'https://www.investopedia.com/thmb/xmG9FV9J_3hd_p8TMktrBG34Rvs=/1620x1080/filters:fill(auto,1)/achievement-agreement-arms-business-agreement-business-deal-cheerful-1448611-pxhere.com-afa4d8399a684cfbb5467402c7639663.jpg',
  'content'=>"Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna
  aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure
   dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident,
   sunt in culpa qui officia deserunt mollit anim id est laborum.",
  'order'=>$count,
  'updated_at'=>now(),

]);
            // code...
        }
    }
}
