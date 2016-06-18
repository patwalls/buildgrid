<?php

namespace BuildGrid;

use LaravelArdent\Ardent\Ardent;

class InvitedSupplier extends Ardent
{
    protected $table = 'invited_suppliers';

    protected $fillable = [
        'name',
        'email',
        'bom_id',
        'hashid'
    ];

    public static $rules = [
        'name'        => 'required',
        'email'       => 'required|email',
        'bom_id'      => 'required|numeric|exists:boms,id'
    ];

    public static $relationsData = [
        'bom' => [self::BELONGS_TO, 'BuildGrid\Bom'],
        'bomResponses' => [self::HAS_MANY, 'BuildGrid\BomResponse'],
    ];

    public function responseAcceptedFromBom()
    {
        return $this->hasManyThrough( 'BuildGrid\BomResponse', 'BuildGrid\Bom', 'id', 'id')->where('bom_responses.status', 'accepted');
    }
}
