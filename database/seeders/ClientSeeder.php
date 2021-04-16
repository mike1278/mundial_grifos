<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Mariangel',
            'email' => 'mariangel@mail.com',
            'password' => '12345678',
        ])->client()->create([
            'lastname' => 'Moya',
            'ci' => '24089369',
            'phone' => '04248307092',
        ]);
    }
}
