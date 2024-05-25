<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GraduationProject extends Model
{
    use HasFactory;



    protected $fillable = [
        'department_id',
        'semester',
        'type',

        'email_1',

        'email_2',

        'name',
        'idea',
        'goal',
        'technologies',
    ];



    public function students(){
        return $this->hasMany(Student::class);
    }


    public function department(){
        return $this->belongsTo(Department::class);
    }

}
