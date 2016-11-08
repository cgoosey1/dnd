<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quest extends Model
{
    public function buildings()
    {
        return $this->hasMany('App\Building', 'questId');
    }

    public function people()
    {
        return $this->hasMany('App\Character', 'questId');
    }

    public function monsters()
    {
        return $this->hasMany('App\Monster', 'questId');
    }
}