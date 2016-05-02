<?php

namespace BuildGrid;

use Illuminate\Database\Eloquent\Model;

class ContactRequest extends Model
{
    protected $fillable = [
      'name',
      'email',
      'message'
    ];
}
