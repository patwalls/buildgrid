<?php

namespace BuildGrid;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'linkedin_id', 'linkedin_token', 'google_id', 'google_token', 'email', 'password',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * A user has many projects relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function projects(){
        return $this->hasMany('BuildGrid\Project');
    }


    /**
     *
     * A user has many Boms through its Projects
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function boms(){
        return $this->hasManyThrough('BuildGrid\Bom', 'BuildGrid\Project');
    }

}
