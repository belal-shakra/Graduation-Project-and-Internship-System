<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;

class AddUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dept_id = 1;

        $fake = Faker::create();
        for ($i=1; $i <= 90 ; $i++) {

            $first_name = $fake->firstName();
            $last_name = $fake->lastName();
            $university_id = '0' . $fake->unique()->numberBetween(191457, 216642);
            $username = strtolower(substr($first_name, 0, 3)) . $university_id;
            $email = $username . '@ju.edu.jo';



            User::create([
                'first_name' => $first_name,
                'last_name' => $last_name,
                'university_id' => $university_id,
                'username' => $username,
                'email' => $email,
                'department_id' => ($i % 3 == 0 && $i % 5 == 0)? $dept_id++ : $dept_id,
                'password' => Hash::make("123"),
                'user_type_id' => 1,
            ]);
        }



        $dept_id = 1;



        for ($i=1; $i <= 42; $i++) {
            $first_name = $fake->firstName();
            $last_name = $fake->lastName();
            $university_id = $fake->unique()->numberBetween(45565, 66579);
            $username = strtolower(substr($first_name, 0, 3)) . $university_id;
            $email = $username . '@ju.edu.jo';


            User::create([
                'first_name' => $first_name,
                'last_name' => $last_name,
                'university_id' => $university_id,
                'username' => $username,
                'email' => $email,
                'department_id' => ($i % 7 == 0)? $dept_id++ : $dept_id,
                'password' => Hash::make("123"),
                'user_type_id' => ($i % 7 == 0)? 3 : 2,
            ]);
        }

    }
}
