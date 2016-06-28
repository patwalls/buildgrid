<?php

namespace BuildGrid;

use Illuminate\Database\Eloquent\SoftDeletes;
use LaravelArdent\Ardent\Ardent;

class Project extends Ardent
{
    use SoftDeletes;

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
        'boms' => [self::HAS_MANY, 'BuildGrid\Bom'],
        'user' => [self::BELONGS_TO, 'BuildGrid\User']
    ];
}
