<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InternshipCourse extends Model
{
    use HasFactory;

    protected $fillable = ['student_id', 'name', 'hour', 'provider', 'certificate'];



    public function student(){
        return $this->belongsTo(Student::class);
    }
}
