<?php

namespace Database\Seeders;

use App\Models\Account;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AccountSeeder extends Seeder
{
    public function run()
    {
        User::all()->each(function (User $user) {
            $user->accounts()->createMany([
                ['name' => 'Savings Account', 'account_number' => 'SAV001', 'balance' => 5000],
                ['name' => 'Check Account', 'account_number' => 'CHK001', 'balance' => 10000],
                ['name' => 'Credit Account', 'account_number' => 'CRD001', 'balance' => -5000],
            ]);
        });
    }
}
