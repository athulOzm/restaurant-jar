<?php

use App\Menutype;
use Illuminate\Database\Seeder;

class MenutypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Menutype::class)->create();
        
    }
}
