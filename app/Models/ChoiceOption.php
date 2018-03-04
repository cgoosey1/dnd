<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChoiceOption extends Model
{
    protected $table = 'choice_option';
    protected $fillable = ['choice_id', 'option_id'];
}