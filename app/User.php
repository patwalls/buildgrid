<?php

namespace BuildGrid;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes as SoftDeletes;

class User extends Authenticatable
{
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'phone', 'company_name', 'position_title', 'password','linkedin_id', 'linkedin_token', 'google_id', 'google_token', 'is_admin'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'google_token', 'google_id', 'linkedin_id', 'linkedin_token'
    ];


    protected $appends = [
        'full_name',
        'total_boms',
        'active_boms_count',
        'invited_suppliers_count',
        'user_status'
    ];

    protected $dates = [
        'last_login',
        'deleted_at'
    ];

    protected $casts = [
        'is_admin' => 'boolean',
    ];


    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function getTotalBomsAttribute()
    {
        return $this->boms()->count();
    }

    public function getActiveBomsCountAttribute()
    {
        return $this->active_boms()->count();
    }

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

    public function active_boms()
    {
        return $this->boms()->where('boms.status', 'active');
    }


    public function getInvitedSuppliersCountAttribute()
    {
        $total = 0;

        foreach($this->boms()->get() as $bom){
            $total += $bom->invited_suppliers_count;
        };

        return $total;
    }

    public function getUserStatusAttribute()
    {
        $status = "Active";

        if ( $this->trashed() ) {
            $status = "Inactive";
        }

        return $status;
    }

}
