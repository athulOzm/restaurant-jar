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
        $this->call(UserSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(MenutypeSeeder::class);
        $this->call(RankSeeder::class);
        $this->call(PaymentTypeSeeder::class);
        $this->call(ProductSeeder::class);




    }
}
