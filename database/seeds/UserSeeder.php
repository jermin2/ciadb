<?php

use Illuminate\Database\Seeder;

use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        User::create([
            'name' => 'serving',
            'email' => 'serving@serving.com',
            'password' => Hash::make('asdfasdf'),
        ]);

        //Make the first user an admin (jermin2@gmail.com);
        DB::table('role_user')->insert([
            ['user_id' => '2', 'role_id' => '2']
        ]);

        User::create([
            'name' => 'guest',
            'email' => 'guest@guest.com',
            'password' => Hash::make('asdfasdf'),
        ]);

        //Make the first user an admin (jermin2@gmail.com);
        DB::table('role_user')->insert([
            ['user_id' => '3', 'role_id' => '3']
        ]);

        factory(User::class, 2)->create();


    }
}
