<?php
namespace app\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class CharacterController extends Controller
{
    public function getIndex() {
        return view('site.character', []);
    }

}