<?php

use App\Deliverylocation;
use Illuminate\Database\Seeder;

class DeliveryLocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Deliverylocation::class, 19)
            ->create();
    }
}
