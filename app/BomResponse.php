<?php

namespace BuildGrid;

use LaravelArdent\Ardent\Ardent;

class BomResponse extends Ardent
{
    protected $table = 'bom_responses';

    protected $fillable = [
        'bom_id',
        'invited_supplier_id',
        'filename',
        'comment'
    ];

    public static $rules = [
        'bom_id'              => 'required|numeric|exists:boms,id',
        'invited_supplier_id' => 'required|numeric|exists:invited_suppliers,id',
        'filename'            => 'required'
    ];

    public static $relationsData = [
        'invitedSupplier' => [self::BELONGS_TO, 'BuildGrid\InvitedSupplier'],
        'bom' => [self::BELONGS_TO, 'BuildGrid\Bom']
    ];
}
