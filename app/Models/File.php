<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $fillable = ['file', 'post_id', 'extension'];



    public function post(){
        return $this->belongsTo(Post::class);
    }
}
