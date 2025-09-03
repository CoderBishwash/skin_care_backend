<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'username' => 'aa',
            'email' => 'aashika@gmail.com',
            'age' => 22,
            'gender' => 'female',
            'password' => Hash::make('123456'), // simple password for testing
        ]);
    }
}
