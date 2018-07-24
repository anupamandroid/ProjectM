<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    //
    protected $fillable = [
        'name',
        'days',
        'hours',
        'company_id',
        'project_id',
        'user_id'
    ];
    
    //A task belongs to a company
    public function company(){
        return $this->belongsTo('App\Company');
    }
    
    //A task belongs to a project
    public function project(){
        return $this->belongsTo('App\Project');
    }
    
    //A task belongs to a user
    public function user(){
        return $this->belongsTo('App\User');
    }
    
    //A task belongs to many users
    public function users(){
        return $this->belongsToMany('App\User');
    }
    
    //A project has a polymorphic relationship with comment
    public function comments(){
        return $this->morphMany('App\Comment', 'commentable');
    }
}
