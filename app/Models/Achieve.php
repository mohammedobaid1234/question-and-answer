<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Achieve extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'badge_id'
    ];

    public $timestamps = false;
}
