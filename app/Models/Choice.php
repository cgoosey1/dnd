<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Choice extends Model
{
    protected $table = 'choice';
    protected $fillable = ['details', 'key'];

    public function races()
    {
        return $this->belongsToMany('App\Race');
    }

    public function options()
    {
        return $this->belongsToMany('App\Option');
    }
}