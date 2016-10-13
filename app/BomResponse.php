<?php

namespace BuildGrid;

use LaravelArdent\Ardent\Ardent;

class BomResponse extends Ardent
{
    protected $table = 'bom_responses';

    protected $touches = ['bom'];

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
    
    public function scopeResponsesNotAccepted($query, $id, $bom_id)
    {
        $query->where('bom_id', $bom_id)
                ->where('id', '<>', $id)
                ->where('status', '<>', 'rejected')
                ->update(['status' => 'not accepted']);
    }
}
