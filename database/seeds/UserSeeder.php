<?php

use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        //admin
        factory(User::class)->create();

        //kitchen
        factory(User::class)->create([
            'name' => 'kitchen',
            'email' => 'kitchen@demo.com',
            'email_verified_at' => now(),
            'password' => '$2y$12$/FXElhbvw8X0f434WjXRZuAxwlqbtet8wFrPX24isHu7IbtzypHSy', // admin123
            'remember_token' => Str::random(10),
            'type'  =>  2
        ]);


        //member
        // factory(User::class)->create([
        //     'name'              =>      'Test Member',
        //     'email'             =>      NULL,
        //     'phone'             =>      '87463758',
        //     'memberid'          =>      'M6453',
        //     'rank_id'           =>      2,
        //     'limit'             =>      null,
        //     'item_limit'        =>      5,
        //     'payment_type_id'   =>      3,
        //     'room_address'      =>      'F-31',
        //     'location'          =>      'BN:113, Way 24, Ruwi - Muscat',
        //     'status'            =>      true,
        //     'type'  =>  2
        // ]);


        //users
        factory(User::class)->create([
            'name' => 'user1',
            'email' => 'user1@demo.com',
            'email_verified_at' => now(),
            'password' => '$2y$12$/FXElhbvw8X0f434WjXRZuAxwlqbtet8wFrPX24isHu7IbtzypHSy', // admin123
            'remember_token' => Str::random(10),
            'type'  =>  5
        ]);
        factory(User::class)->create([
            'name' => 'user2',
            'email' => 'user2@demo.com',
            'email_verified_at' => now(),
            'password' => '$2y$12$/FXElhbvw8X0f434WjXRZuAxwlqbtet8wFrPX24isHu7IbtzypHSy', // admin123
            'remember_token' => Str::random(10),
            'type'  =>  5
        ]);

  

        //waiter
        factory(User::class)->create([
            'name' => 'Waiter One',
            'phone' => '77778767',
            'email' => 'waiter@demo.com',
            'type'  =>  4
        ]);
        factory(User::class)->create([
            'name' => 'Waiter Two..',
            'email' => 'waiter2@demo.com',
            'phone' => '75778787',
            'type'  =>  4
        ]);
        factory(User::class)->create([
            'name' => 'Waiter 3',
            'phone' => '77775787',
            'email' => 'waiter3@demo.com',
            'type'  =>  4
        ]);

        
        
    }
}
