<?php

use App\PaymentStatus;
use Illuminate\Database\Seeder;

class PaymentstatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(PaymentStatus::class)->create();
        factory(PaymentStatus::class)->create([
            'name' => 'Partial'
        ]);
        factory(PaymentStatus::class)->create([
            'name' => 'Paid'
        ]);
    }
}
