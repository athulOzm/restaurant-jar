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
        factory(User::class)->create();
        factory(User::class)->create([
            'name' => 'store',
            'email' => 'store@demo.com',
            'email_verified_at' => now(),
            'password' => '$2y$12$/FXElhbvw8X0f434WjXRZuAxwlqbtet8wFrPX24isHu7IbtzypHSy', // admin123
            'remember_token' => Str::random(10),
            'type'  =>  2
        ]);

        
        
    }
}
