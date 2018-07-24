<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    //
    protected $fillable = [
        'name',
        'description',
        'days',
        'company_id',
        'user_id'
    ];
    
    //A project belongs to a company
    public function company(){
        return $this->belongsTo('App\Company');
    }
    
    //A project belongs to many users
    public function users(){
        return $this->belongsToMany('App\User');
    }
    
    //A project has a polymorphic relationship with comment
    public function comments(){
        return $this->morphMany('App\Comment', 'commentable');
    }
}
