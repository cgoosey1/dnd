<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RaceTrait extends Model
{
    protected $table = 'race_trait';
    protected $fillable = ['race_id', 'trait_id'];
}