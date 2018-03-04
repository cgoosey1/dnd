<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TraitModel extends Model
{
    protected $table = 'trait';
    protected $fillable = ['name', 'showInFeature', 'details', 'shortDetails', 'attributes'];

    public function races()
    {
        return $this->belongsToMany('App\Race');
    }
}