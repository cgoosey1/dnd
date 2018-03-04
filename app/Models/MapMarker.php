<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MapMarker extends Model
{
    protected $fillable = ['x', 'y', 'size', 'marker', 'color', 'bold', 'italic', 'underline', 'text'];
}