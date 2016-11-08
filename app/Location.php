<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    public function buildings()
    {
        return $this->hasMany('App\Building', 'locationId');
    }

    public function people()
    {
        return $this->hasMany('App\Character', 'locationId');
    }

    public function monsters()
    {
        return $this->hasMany('App\Monster', 'locationId');
    }
}