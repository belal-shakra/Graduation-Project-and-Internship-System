<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WeeklyFollowing extends Model
{
    use HasFactory;

    protected $fillable = ['task', 'hour', 'description', 'week', 'student_id'];


    public function student(){
        return $this->belongsTo(Student::class);
    }

}
