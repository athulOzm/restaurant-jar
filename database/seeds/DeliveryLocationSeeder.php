<?php

use App\Deliverylocation;
use Illuminate\Database\Seeder;
use App\Branch;

class DeliveryLocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Deliverylocation::class)->create([
            'name'  =>  'Talabat',
            'branch_id'   =>  Branch::first()->id
        ]);

        factory(Deliverylocation::class)->create([
            'name'  =>  'Akeed',
            'branch_id'   =>  Branch::first()->id
        ]);

        factory(Deliverylocation::class)->create([
            'name'  =>  'Other',
            'branch_id'   =>  Branch::first()->id
        
        ]);
    }
}
