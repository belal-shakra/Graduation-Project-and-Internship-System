<?php

namespace Database\Seeders;

use App\Models\Student;
use App\Models\User;
use App\Models\UserType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;


class AddStudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $fake = Faker::create();
        $student_users_num = User::where("user_type_id", UserType::firstWhere("name", "student")->id)->count();

        $count = 1;
        for ($i=1; $i <= $student_users_num; $i++) {

            if($count <= 5){
                $in_gp = true;
                $in_int = true;
                $hour = $fake->numberBetween(121, 129);
            }

            elseif($count <= 10){
                if ($count % 2 == 0){
                    $in_gp = false;
                    $in_int = true;
                }
                else{
                    $in_gp = true;
                    $in_int = ($count == 9)? true : false;
                }
                $hour = $fake->numberBetween(110, 120);
            }

            elseif($count <= 15){
                $in_gp = false;
                $in_int = false;
                $hour = ($count<14)? $fake->numberBetween(90, 95): $fake->numberBetween(60, 89);;
            }


            if($i%3 == 0 && $i%5 == 0)
                $count = 1;
            else
                $count++;





            Student::create([
                'hour' => $hour,
                'in_internship' => $in_int,
                'in_graduation_project' => $in_gp,
                'user_id' => $i,
            ]);
        }


    }
}
