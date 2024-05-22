<?php

namespace Database\Seeders;

use App\Models\Supervisor;
use App\Models\User;
use App\Models\UserType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AddSupervisorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $supervisor_users = User::where('user_type_id', '!=', UserType::firstWhere('name', 'student')->id)->get();
        foreach ($supervisor_users as $supervisor) {
            Supervisor::create([
                'user_id' => $supervisor->id,
            ]);
        }
    }
}
