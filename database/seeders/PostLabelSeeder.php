<?php

namespace Database\Seeders;

use App\Models\PostLabel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostLabelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $labels = [
            'important' => 'danger',
            'documaentation' => 'primary',
            'new release' => 'info',
            'final release' => 'success',
            'update' => 'secondary',
            'research' => 'dark',
            'programming' => 'warning',
            'web' => 'success',
            'mobile' => 'dark',
            'network' => 'primary',
            'cyber security' => 'warning',
            'ai' => 'info',
            'machine learning' => 'secondary',
            'problem' => 'danger',
        ];



        foreach($labels as $name=>$class){
            PostLabel::create([
                'name'=>$name,
                'class'=>$class
            ]);
        }
    }
}
