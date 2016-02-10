<?php

namespace BuildGrid;

use LaravelArdent\Ardent\Ardent;

class Project extends Ardent
{
    protected $table = 'projects';

    protected $fillable = [
        'name',
        'user_id'
    ];

    public static $rules = [
        'name' => 'required',
        'user_id' => 'required|numeric|exists:users,id',
    ];

    public static $relationsData = [
        'boms' => [self::HAS_MANY, 'Bom'],
        'user' => [self::BELONGS_TO, 'User']
    ];
}
