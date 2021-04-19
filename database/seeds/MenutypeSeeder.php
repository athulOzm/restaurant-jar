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
        factory(Menutype::class)->create([
            'name'  =>  'Lunch',
            'from'  =>  '12:00',
            'to'    =>  '16:00'
        ]);
        factory(Menutype::class)->create([
            'name'  =>  'Dinner',
            'from'  =>  '16:00',
            'to'    =>  '21:00'
        ]);
        
    }
}


