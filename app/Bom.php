<?php

namespace BuildGrid;

use Illuminate\Database\Eloquent\SoftDeletes;
use LaravelArdent\Ardent\Ardent;

class Bom extends Ardent
{
    use SoftDeletes;

    protected $table = 'boms';

    protected $fillable = [
        'name',
        'project_id',
        'filename',
        'bom_description'
    ];

    protected $appends = [
        'bom_purchaser',
        'project_name',
        'invited_suppliers_count',
        'bg_responded_yes_no'
    ];


    protected $casts = [
        'bg_responded' => 'boolean',
    ];

    protected $touches = [
        'project'
    ];


    public static $rules = [
        'name'       => 'required',
        'project_id' => 'required|numeric|exists:projects,id',
        'filename'   => 'required'
    ];

    public static $relationsData = [
        'invitedSuppliers' => [self::HAS_MANY, 'BuildGrid\InvitedSupplier'],
        'responses' => [self::HAS_MANY, 'BuildGrid\BomResponse'],
        'project' => [self::BELONGS_TO, 'BuildGrid\Project']
    ];


    public function getBomPurchaserAttribute()
    {
        $user = User::withTrashed()->find($this->project->user_id);
        return $user->full_name;
    }


    public function getProjectNameAttribute()
    {
        return $this->project->name;
    }


    public function getInvitedSuppliersCountAttribute()
    {
        return $this->invited_suppliers->count();
    }


    public function getBgRespondedYesNoAttribute()
    {
        return ($this->bg_responded == true) ? 'Yes' : 'No';
    }
}
