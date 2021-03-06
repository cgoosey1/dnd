<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = ['name', 'description', 'type', 'parent'];

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

    public function children()
    {
        return $this->hasMany('App\Location', 'parent');
    }

    public function traps()
    {
        return $this->hasMany('App\Trap', 'locationId');
    }
}