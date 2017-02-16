<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Monster extends Model
{
    protected $fillable = ['locationId', 'buildingId', 'questId', 'name', 'race', 'description', 'hp'];

    public function classes()
    {
        return $this->belongsTo('App\Classes', 'class');
    }
}