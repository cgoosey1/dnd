<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    protected $table = 'option';
    protected $fillable = ['value'];

    public function choices()
    {
        return $this->belongsToMany('App\Choice');
    }
}