<?php

namespace Tests\Feature;

use App\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
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


        $user = factory(\App\User::class)->create();

        $this->actingAs($user)
            ->post(route('product.store', $this->data()));

        $this->assertEquals(1, Product::all()->count());       
    }

    /** @test */
    public function can_upload_image()
    {

        $this->withoutExceptionHandling();
        Storage::fake('upload');

        $user = factory(\App\User::class)->create();

        $this->actingAs($user)
            ->post(route('product.store', [
                'cover' => UploadedFile::fake()->image('photo1.jpg'),
                'name' => 'product one',
                'user_id'   => 1,
                'price' =>  "3.500",
                'body'  =>  'descritpion... ',
            ]));

  

        // Assert one or more files were stored...
        Storage::disk('public')->assertExists('photo1.jpg');
      
    }

   

    public function data(){

        

        return [
            'name' => 'product one',
            'user_id'   => 1,
            'price' =>  "3.500",
            'body'  =>  'descritpion... ',
            'cover' =>  ''
        ];
    }

    
    
}
