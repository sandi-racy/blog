<?php

use App\User;
use Faker\Factory;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        for ($i = 1; $i <= 5; $i++) {
            $name = $faker->firstName . ' ' . $faker->lastName;
            User::create([
                'name' => $name,
                'password' => bcrypt('password')
            ]);
        }
    }
}
