<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
class Question extends Model
{
    use HasFactory;
    protected $fillable =[
        'title',
        'body',
        'slug',
        'description',
        'votes',
        'status',
        'user_id',
        'view'
    ];
    
    public function setBodyAttribute($value)
    {
        $this->attributes['body'] = $value; 
        $this->attributes['slug'] = Str::slug($value);
        // $this->attributes['user_id'] = Auth::user()->id ; 
    }
    public function answers()
    {
        return $this->hasMany(
            Answer::class,
            'question_id',
            'id'
        );  
    }
    public function tags(){
        return $this->belongsToMany(
            Tag::class,
            'tag_questions',
            'question_id',
            'tag_id',
            'id',
            'id'
        );
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
