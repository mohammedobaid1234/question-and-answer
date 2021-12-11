<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Badge extends Model
{
    use HasFactory;
    
    public function getImageUrlAttribute($value)
    {
        // dd(asset('images/placeholder.png'));
        if(!$this->image){
            return asset('images/placeholder.png');
        }
        if(stripos($this->image , 'https') ===  0){
            return $this->image;
        }
        return asset('uploads/' . $this->image);
    }
    public function users()
    {
        return $this->belongsToMany(User::class, 'achieves');
    }  
}
