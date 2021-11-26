<?php

use App\PurchaseStatus;
use Illuminate\Database\Seeder;

class PurchaseStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(PurchaseStatus::class)->create([
            'name' => 'Ordered'
        ]);

        

        factory(PurchaseStatus::class)->create([
            'name' => 'Partial'
        ]);
        factory(PurchaseStatus::class)->create([
            'name' => 'Pending'
        ]);
        factory(PurchaseStatus::class)->create();
        

        
    }
}
