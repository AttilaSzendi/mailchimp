<?php

use App\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    public function run()
    {
        User::query()->create([
            'name' => 'administrator',
            'email' => 'admin@mailchimp.io',
            'password' => bcrypt('password'),
            'newsletter_subscription' => true,
        ]);

        foreach (range(1, 9) as $number) {
            User::query()->create([
                'name' => 'user_' . $number,
                'email' => "user$number@mailchimp.io",
                'password' => bcrypt('password'),
                'newsletter_subscription' => rand(0, 1),
            ]);
        }
    }
}
