<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'email', 
        'password',
        'first_name',
        'middle_name',
        'last_name',
        'city',
        'role_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    //A user has many tasks
    /*public function tasks(){
        return $this->hasMany('App\Models\Task');
    }*/
    
    //A user has many comments
    /*public function comments(){
        return $this->hasMany('App\Comment');
    }*/
    
    //A user has many companies
    public function companies(){
        return $this->hasMany('App\Company');
    }
    
    //A user belongs to a role
    public function role(){
        return $this->belongsTo('App\Role');
    }
    
    //A user belongs to many tasks
    public function tasks(){
        return $this->belongsToMany('App\Task');
    }
    
    //A user belongs to many projects
    public function projects(){
        return $this->belongsToMany('App\Project');
    }
    
    //A project has a polymorphic relationship with comment
    public function comments(){
        return $this->morphMany('App\Comment', 'commentable');
    }
}
