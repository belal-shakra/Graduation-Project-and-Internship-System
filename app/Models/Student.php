<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;


    protected $fillable = [
        'hour',
        'in_internship',
        'in_graduation_project',
        'user_id',
    ];



    public function user(){
        return $this->belongsTo(User::class);
    }

    public function supervisor(){
        return $this->belongsTo(Supervisor::class);
    }


    public function internship_company(){
        return $this->hasOne(InternshipCompany::class);
    }


    public function weekly_followings(){
        return $this->hasMany(WeeklyFollowing::class);
    }


    public function internship_courses(){
        return $this->hasMany(InternshipCourse::class);
    }

    public function graduation_project(){
        return $this->belongsTo(GraduationProject::class);
    }

}
