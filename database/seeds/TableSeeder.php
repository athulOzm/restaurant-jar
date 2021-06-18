<?php

use App\Setting;
use App\Table;
use Illuminate\Database\Seeder;

class TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Table::class, 9)
            ->create();

        factory(Setting::class, 1)
            ->create();
    }
}
