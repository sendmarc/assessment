<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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
            'name' => 'Jacques Artgraven',
            'email' => 'jacques@artgraven.guru',
            'role' => 'admin',
            'password' => Hash::make('Password123*')
        ]);
    }
}
