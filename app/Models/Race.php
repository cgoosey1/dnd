<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Race extends Model
{
    protected $table = 'race';
    protected $fillable = ['name', 'abilityScoreIncrease', 'age', 'alignment', 'size', 'speed', 'parentId'];

    public function proficiencies()
    {
        return $this->belongsToMany('App\Proficiency');
    }

    public function choices()
    {
        return $this->belongsToMany('App\Choice');
    }

    public function languages()
    {
        return $this->belongsToMany('App\Language');
    }

    public function traits()
    {
        return $this->belongsToMany('App\TraitModel');
    }
}