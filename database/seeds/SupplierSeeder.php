<?php

use App\Supplier;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Supplier::class)->create([
            'name' => 'Default Supplier',
            'phone' => '0000-1111',
            'address' => 'Address..',
            'tax_number' => '456789654'
        ]);
    }
}
