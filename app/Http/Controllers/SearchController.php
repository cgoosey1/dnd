<?php
namespace app\Http\Controllers;

use App\Spell;
use Illuminate\Routing\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


class SearchController extends Controller
{
    public function getIndex(Request $request)
    {
        $keywords = $request->input('keywords');
        $spells = Spell::where('name', 'LIKE', '%' .$keywords . '%')->limit(10)->get();

        return JsonResponse::create($spells->toArray());
    }
}