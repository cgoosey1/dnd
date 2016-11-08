<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Building extends Model
{
    public function people()
    {
        return $this->hasMany('App\Character', 'buildingId');
    }

    public function monsters()
    {
        return $this->hasMany('App\Monster', 'buildingId');
    }
}