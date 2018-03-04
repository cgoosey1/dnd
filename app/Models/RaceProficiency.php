<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RaceProficiency extends Model
{
    protected $table = 'race_proficiency';
    protected $fillable = ['race_id', 'proficiency_id'];
}