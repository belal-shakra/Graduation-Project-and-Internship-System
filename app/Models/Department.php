<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'no_team_member', 'start', 'end', 'week'];



    public function users(){
        return $this->hasMany(User::class);
    }


    public function graduation_projects(){
        return $this->hasMany(GraduationProject::class);
    }
}
