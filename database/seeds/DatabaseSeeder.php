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
        $this->call(BranchSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(MenutypeSeeder::class);
        $this->call(RankSeeder::class);
        $this->call(PaymentTypeSeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(TableSeeder::class);
        $this->call(AddonSeeder::class);
        $this->call(DeliveryLocationSeeder::class);
        $this->call(PurchaseStatusSeeder::class);
        $this->call(PaymentstatusSeeder::class);
        $this->call(SupplierSeeder::class);




    }
}
