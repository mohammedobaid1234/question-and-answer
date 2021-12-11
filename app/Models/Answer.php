<?php

namespace App\Models;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Answer extends Model
{
    use HasFactory;
    protected $fillable = [
        'body',
        'user_id',
        'question_id',
        'votes',
        'status'
    ];

    public function setBodyAttribute($value)
    {
        $this->attributes['body'] = $value; 
        $this->attributes['slug'] = Str::slug($value);
        $this->attributes['user_id'] = Auth::user()->id; 

    }
    public function question()
    {
        return $this->belongsTo(
            Question::class,
            'question_id',
            'id'
        )->withDefault();
    }

    public function user()
    {
        return $this->belongsTo(
            User::class,
            'user_id',
            'id'
        )->withDefault();
    }
}
