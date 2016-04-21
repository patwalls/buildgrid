<?php

namespace BuildGrid;

use LaravelArdent\Ardent\Ardent;

class Bom extends Ardent
{
    protected $table = 'boms';

    protected $fillable = [
        'name',
        'project_id',
        'filename',
        'bom_description'
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
}
