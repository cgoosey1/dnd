<?php
namespace app\Http\Controllers;

use App\Location;
use App\Screen;
use App\Quest;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function getIndex($id) {
        $location = Location::find($id);
        $screens = Screen::where(['type' => 1, 'typeId' => $location->id])->get();

        return view('site.home', [
            'locations' => Location::where('parent', $id)->get(),
            'quests' => Quest::orderBy('completed')->get(),
            'details' => $location,
            'screens' => $screens]);
    }

    public function postIndex(Request $request, $id) {
        $location = Location::find($id);
        $location->description = $request->input('description');
        $location->save();

        return redirect('/location/' . $id);
    }

    public function postAdd(Request $request) {
        $data = array_where($request->all(), function($value) {
            return $value != '';
        });

        if ($id = $request->input('id')) {
            $location = Location::find($id);
            $location->update($data);
        } else {
            $location = Location::create($data);
        }
            $location->save();

        return redirect('/location/' . $location->id);
    }
}