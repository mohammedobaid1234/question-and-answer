<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'major',
        'birth_date'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    public function answers()
    {
        return $this->hasMany(
            Answer::class,
        ); 
    }
    public function questions()
    {
        return $this->hasMany(Question::class);
    }
    public function badges()
    {
        return $this->belongsToMany(Badge::class, 'achieves');
    }
    public function setNameAttribute($name){
        $this->attributes['name'] = $name;
        $this->attributes['slug'] = Str::slug($name);
    } 
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function hasAbility($ability)
    {
        // return true;
        $user = Auth::user();
      $badge = $user->badges->last();
      if($badge){

          if($badge->name == 'silver' || $badge->name == 'gold'){
            return true;
          }
          
        }
        return false;
    }
    public function receivesBroadcastNotificationsOn()
    {
        return 'Notifications.' . $this->id;
        
    }
    
}
