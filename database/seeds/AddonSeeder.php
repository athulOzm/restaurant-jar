<?php

use App\Addon;
use Illuminate\Database\Seeder;

class AddonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Addon::class)
            ->create();

        factory(Addon::class)
            ->create([
                'name'  =>  'Tea',
                'price' =>  1.200
            ]);

        factory(Addon::class)
            ->create([
                'name'  =>  'Ice Tea',
                'price' =>  1.600
            ]);
    }
}
