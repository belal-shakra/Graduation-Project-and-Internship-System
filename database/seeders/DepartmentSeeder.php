<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $depts =[
            'Computer Science',
            'Computer Information system',
            'Information Technology',
            'Artificial Intelligence',
            'Data Science',
            'Cyber Security',
        ];

        for ($i=0; $i < count($depts); $i++) {
            Department::create([
                'name' => $depts[$i],
                'no_team_member' => 4,
                'week' => 1,
            ]);
        }
    }
}
