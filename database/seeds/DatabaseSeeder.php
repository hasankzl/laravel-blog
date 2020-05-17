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
        $this->call(countrySeeder::class);
        $this->call(citySeeder::class);
        $this->call(semtSeeder::class);
        $this->call(districtSeeder::class);
        $this->call(villageSeeder::class);
        $this->call(neighborhoodSeeder::class);
        $this->call(avenueSeeder::class);
        $this->call(streetSeeder::class);
        $this->call(addressSeeder::class);
        $this->call(statusSeeder::class);
        $this->call(seyhulislamSeeder::class);
        $this->call(makerSeeder::class);
        $this->call(padisahSeeder::class);
        $this->call(centurySeeder::class);
        $this->call(architectSeeder::class);
        $this->call(categorySeeder::class);
        $this->call(articleSeeder::class);
        $this->call(imagesSeeder::class);
        $this->call(PageSeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(ConfigSeeder::class);
    }
}
