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
        $users = [
            [
                'first_name' => 'us1',
                'last_name' => 'us1',
                'email' => 'us1@us.it',
                'password' => Hash::make('user1'),
                'date_of_birth' => '1990-02-26',
                'user_type' => 0,
                'about' => 'Reach more buyers and drive higher conversion with the only payments platform that delivers PayPal, Venmo (in the US), credit and debit cards, and'
            ],
            [
                'first_name' => 'us2',
                'last_name' => 'us2',
                'email' => 'us2@us.it',
                'password' => Hash::make('user2'),
                'date_of_birth' => '1990-05-14',
                'user_type' => 1,
                'about' => 'Reach more buyers and drive higher conversion with the only payments platform that delivers PayPal, Venmo (in the US), credit and debit cards, and'
            ],
            [
                'first_name' => 'us3',
                'last_name' => 'us3',
                'email' => 'us3@us.it',
                'password' => Hash::make('user3'),
                'date_of_birth' => '1990-07-16',
                'user_type' => 1,
                'about' => 'Reach more buyers and drive higher conversion with the only payments platform that delivers PayPal, Venmo (in the US), credit and debit cards, and'

            ]
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
