<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = ['student', 'supervisor', 'supervisor&head'];
        for ($i=0; $i < count($types); $i++) {
            UserType::create([
                'name' => $types[$i],
            ]);
        }
    }
}
