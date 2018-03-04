<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RaceChoice extends Model
{
    protected $table = 'race_choice';
    protected $fillable = ['race_id', 'choice_id'];
}