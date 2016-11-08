<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    protected $fillable = ['locationId', 'buildingId', 'name', 'race', 'description', 'class', 'hp'];
}