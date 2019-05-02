<?php

use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\User::create([
            'name' => 'Admin',
            'email' => 'ubaedillahedi@gmail.com',
            'password' => bcrypt('secret'),
            'role' => 'admin'
        ]);

        App\User::create([
            'name' => 'Customer',
            'email' => 'ediubaedillahsosmed@gmail.com',
            'password' => bcrypt('secret'),
            'role' => 'customer'
        ]);
    }
}
