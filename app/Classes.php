<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    public function monsters()
    {
        return $this->hasMany('App\Monster', 'class');
    }

    public function modifer($stat)
    {
        return floor(($stat - 10)/2);
    }

}