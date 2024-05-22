<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InternshipCompany extends Model
{
    use HasFactory;


    protected $fillable = [
        'company_name',
        'address',
        'starting_date',
        'ending_date',
        'supervisor_name',
        'supervisor_email',
        'description',
        'technologies',
        'student_id',
    ];


    public function student(){
        return $this->belongsTo(Student::class);
    }
}
