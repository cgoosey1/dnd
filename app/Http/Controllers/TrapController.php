<?php
namespace app\Http\Controllers;

use App\Location;
use App\Quest;
use App\Trap;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class TrapController extends Controller
{
    public function postIndex(Request $request) {
        $data = array_where($request->all(), function($value) {
            return $value != '';
        });

        if ($id = $request->input('id')) {
            $trap = Trap::find($id);
            $trap->update($data);
        } else {
            $trap = Trap::create($data);
        }
        $trap->save();

        if ($buildingId = $request->input('buildingId')) {
            return redirect('/building/' . $buildingId);
        }
        if ($questId = $request->input('questId')) {
            return redirect('/quest/' . $questId);
        }

        return redirect('/location/' . $request->input('locationId'));
    }

    public function getDelete($id) {
        $trap = Trap::find($id);
        if (!$trap) {
            return redirect('/location/1');
        }

        $questId = $trap->questId;
        $locationId = $trap->locationId;
        $trap->delete();

        if ($questId) {
            return redirect('/quest/' . $questId);
        }

        return redirect('/location/' . $locationId);
    }
}