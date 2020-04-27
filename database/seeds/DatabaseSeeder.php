<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(citySeeder::class);
        $this->call(addressSeeder::class);
        $this->call(makerSeeder::class);
        $this->call(categorySeeder::class);
        $this->call(articleSeeder::class);
        $this->call(PageSeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(ConfigSeeder::class);
    }
}
