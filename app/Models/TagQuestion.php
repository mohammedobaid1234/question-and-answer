<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TagQuestion extends Model
{
    use HasFactory;
    protected $primaryKey = ['question_id', 'tag_id'];
    public $incrementing = false;
    protected $fillable = [
        'question_id',
        'tag_id'
    ];
}
