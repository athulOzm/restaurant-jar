<?php

namespace Tests\Feature;

use App\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductManageTest extends TestCase
{
    use RefreshDatabase;


    /** @test */
    public function only_admin_can_manage_products(){

        $this->get(route('product.index'))
            ->assertStatus(302);
    }

    /** @test */
    public function admin_can_index_products(){

        $user = factory(\App\User::class)->create();
        
        $response = $this->actingAs($user)
             ->get(route('product.index'));

        $response->assertStatus(200);    
    }

    /** @test */
    public function admin_can_store_product(){

        $this->withoutExceptionHandling();

        $user = factory(\App\User::class)->create();

        $this->actingAs($user)
            ->post(route('product.store', $this->data()));

        $this->assertEquals(1, Product::all()->count());       
    }

    public function data(){

        return [
            'name' => 'product one',
            'user_id'   => 1,
            'price' =>  "3.500",
            'body'  =>  'descritpion... ',
            'image' =>  'dummy.jpg'
        ];
    }

    
    
}
