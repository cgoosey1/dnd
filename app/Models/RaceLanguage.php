<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RaceLanguage extends Model
{
    protected $table = 'race_language';
    protected $fillable = ['race_id', 'language_id'];
}