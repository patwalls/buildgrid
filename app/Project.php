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

    protected $casts = [
        'user_id' => 'int'
    ];

    public static $rules = [
        'name' => 'required',
        'user_id' => 'required|numeric|exists:users,id',
    ];

    public static $relationsData = [
        'user' => [self::BELONGS_TO, 'BuildGrid\User']
    ];
    
    public function boms()
    {
        return $this->hasMany('BuildGrid\Bom')->withTrashed();
    }
}
