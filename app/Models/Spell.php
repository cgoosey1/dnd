<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Spell extends Model
{
    public $timestamps = false;
    protected $fillable = ['name', 'casting_time', 'components', 'classes', 'concentration', 'duration', 'level', 'source', 'range', 'ritual', 'school', 'description'];
}