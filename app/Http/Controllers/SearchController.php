<?php
namespace app\Http\Controllers;

use App\Location;
use App\Spell;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Routing\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


class SearchController extends Controller
{
    public function getIndex(Request $request)
    {
        $type = $request->input('type', null);
        $keywords = explode(' ', $request->input('keywords'));
        $whereArray = [];
        foreach ($keywords as $word) {
            $whereArray[] = ['name', 'LIKE', '%' . $word . '%'];
        }

        $search = Collection::make();
        if (!$type || $type == 'Spell') {
            $search = $search->merge(Spell::where($whereArray)->limit(10)->get());
        }
        if (!$type || $type == 'Location') {
            $search = $search->merge($locations = Location::where($whereArray)->limit(10)->get());
        }

        $search = $search->sort(function($a, $b) use ($keywords) {
                $countA = $countB = 0;
                foreach ($keywords as $word) {
                    $countA += substr_count(strtolower($a->name), $word);
                    $countB += substr_count(strtolower($b->name), $word);
                }

                if ($countA == $countB) {
                    return 0;
                }

                return ($countA < $countB) ? 1 : -1;
            })
            ->take(10)
            ->each(function($object) {
                $object->type = substr(get_class($object), 4);

                return $object;
            });

        return JsonResponse::create($search->toArray());
    }
}