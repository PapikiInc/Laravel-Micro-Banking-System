<?php

namespace Database\Seeders;

use App\Models\Account;
use App\Models\AccountTransaction;
use App\Models\User;
use Illuminate\Database\Seeder;

class AccountTransactionSeeder extends Seeder
{
    public function run()
    {
        $users = User::all();

        foreach ($users as $user) {
            $accounts = $user->accounts;
            foreach ($accounts as $account) {
                $this->createRandomTransactions($account);
            }
        }
    }

    private function createRandomTransactions(Account $account)
    {
        $startDate = now()->subMonths(6);
        $endDate = now();
        $openingBalance = $account->balance;

        while ($startDate <= $endDate) {
            $transactionCount = rand(0, 2);
            $totalDebits = 0;
            $totalCredits = 0;

            for ($i = 0; $i < $transactionCount; $i++) {
                $date = $startDate->copy()->addDays($i);
                $amount = $this->getRandomAmount($account);
                $isCredit = $this->getRandomIsCredit();

                if ($isCredit) {
                    $totalCredits += $amount;
                } else {
                    $totalDebits += $amount;
                }

                $account->transactions()->create([
                    'date' => $date,
                    'opening_balance' => $openingBalance,
                    'total_debits' => $totalDebits,
                    'total_credits' => $totalCredits,
                    'closing_balance' => $openingBalance + $totalCredits - $totalDebits,
                ]);
            }

            $openingBalance += $totalCredits - $totalDebits;
            $startDate = $startDate->addDays($transactionCount + rand(0, 2));
        }
    }

    private function getRandomAmount(Account $account)
    {
        $balance = $account->balance;

        if (rand(0, 3) < 3 && $balance > 0) {
            $amount = round($balance * 0.8);
        } else {
            $amount = rand(10, $balance > 1000 ? $balance / 10 : $balance);
        }

        return $amount;
    }

    private function getRandomIsCredit()
    {
        return rand(0, 3) < 3;
    }
}
