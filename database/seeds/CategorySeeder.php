<?php

use App\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Category::class)->create(['name'  =>  'Bread']);
        factory(Category::class)->create(['name'  =>  'Snacks']);
        factory(Category::class)->create(['name'  =>  'Soups']);
        factory(Category::class)->create(['name'  =>  'Vegitables']);
    }
}


 