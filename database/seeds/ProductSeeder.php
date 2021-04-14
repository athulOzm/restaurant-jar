<?php

use App\Category;
use App\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Product::class, 6)
            ->create()
            ->each(function ($product) {
                $product->categories()->attach(Category::all()->random());
            });;
    }
}
