<?php

namespace Database\Seeders;

use App\Models\User;
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
        $user = User::create([
            'name' => 'Roberto',
            'email' => 'michelettiroberto7@gmail.com',
            'password' => '12345678',
        ]);
        $user->attachRole('superAdmin');
        $user->markEmailAsVerified();

        $user = User::create([
            'name' => 'admin',
            'email' => 'admin@mail.com',
            'password' => '12345678',
        ]);
        $user->attachRole('admin');
        $user->markEmailAsVerified();
    }
}
