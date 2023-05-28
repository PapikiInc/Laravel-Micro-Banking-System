<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        $adminUser = User::where('email', 'admin@example.com')->first();

        if (!$adminUser) {
        User::create([
            'name' => 'Admin User',
            'email' => env('DEFAULT_USER_EMAIL', 'admin@example.com'),
            'password' => Hash::make(env('DEFAULT_USER_PASSWORD', 'password')),
        ]);
    }
        User::factory()->count(4)->create();
    }
}
