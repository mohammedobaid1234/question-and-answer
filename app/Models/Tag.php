<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;
    public function questions(){
        return $this->belongsToMany(
            Question::class,
            'tag_questions',
            'tag_id',
            'question_id',
            'id',
            'id'
        );
    }
   
}
