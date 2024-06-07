<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['post', 'user_id', 'graduation_project_id', 'label_pattern'];



    public function graduation_project(){
        return $this->belongsTo(GraduationProject::class);
    }


    public function user(){
        return $this->belongsTo(User::class);
    }


    public function comments(){
        return $this->hasMany(Comment::class);
    }
}
