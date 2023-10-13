<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Faker::create();
        for ($i = 1; $i <= 30; $i++){
            $user = new User();
            $user->full_name = $faker->name;
            $user->email = $faker->email;
            $user->password = $faker->password;
            $user -> save();
        }
    }
}
