<?php

use App\PaymentType;
use Illuminate\Database\Seeder;

class PaymentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(PaymentType::class)->create([
            'name' => 'Card'
        ]);

        factory(PaymentType::class)->create([
            'name' => 'Cash'
        ]);

        factory(PaymentType::class)->create([
            'name' => 'Online'
        ]);
    }
}
