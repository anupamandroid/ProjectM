<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    //
    protected $fillable = [
        'name',
        'description',
        'user_id'
    ];
    
    //A company belongs to a user
    public function user(){
        return $this->belongsTo('App\User');
    }
    
    //A company has many projects
    public function projects(){
        return $this->hasMany('App\Project');
    }
    
    //A project has a polymorphic relationship with comment
    public function comments(){
        return $this->morphMany('App\Comment', 'commentable');
    }
}
