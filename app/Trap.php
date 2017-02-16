<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trap extends Model
{
    const TYPE_MECHANICAL       = 1;
    const TYPE_MAGICAL          = 2;
    const DIFFICULTY_SET_BACK   = 1;
    const DIFFICULTY_DANGEROUS  = 2;
    const DIFFICULTY_DEADLY     = 3;

    protected $fillable = ['name', 'type', 'difficulty', 'characterLevel', 'trigger', 'description', 'detectDC', 'disarmDC', 'saveDC', 'attackMod', 'damage', 'complex', 'template', 'initiative', 'spell', 'spellcasterLevel', 'locationId', 'questId'];
}