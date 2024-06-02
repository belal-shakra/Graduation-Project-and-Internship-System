<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supervisor extends Model
{
    use HasFactory;


    public function user(){
        return $this->belongsTo(User::class);
    }

    public function students(){
        return $this->belongsTo(Student::class);
    }

    public function graduation_project(){
        return $this->belongsTo(GraduationProject::class);
    }


}
