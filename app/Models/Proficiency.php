<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proficiency extends Model
{
    protected $table = 'proficiency';
    protected $fillable = ['name'];

    public function races()
    {
        return $this->belongsToMany('App\Race');
    }
}