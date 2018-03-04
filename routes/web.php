<?php
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    $locations = \App\Location::all();
    $location = $locations->first();

    return redirect('/location/' . $location->id);
});

Route::get('/location/{id}', 'LocationController@getIndex');
Route::post('/location/add', 'LocationController@postAdd');
Route::post('/location/{id}', 'LocationController@postIndex');

Route::get('/map', 'MapController@getIndex');
Route::post('/map/add', 'MapController@postAdd');
Route::get('/map/delete/{id}', 'MapController@getDelete');

Route::post('/trap/add', 'TrapController@postIndex');
Route::get('/trap/delete/{id}', 'TrapController@getDelete');

Route::get('/search', 'SearchController@getIndex');

Route::get('/character', 'CharacterController@getIndex');

Route::get('/quest/{id}', function ($id) {

    $quest = \App\Quest::find($id);
    $screens = \App\Screen::where(['type' => 3, 'typeId' => $quest->id])->get();
//    dd($quest->monsters()->first());
    return view('site.home', [
        'locations' => \App\Location::all(),
        'quests' => \App\Quest::orderBy('completed')->get(),
        'details' => $quest,
        'screens' => $screens]);
});


Route::post('/quest/{id}', function (Request $request, $id) {
    $location = \App\Quest::find($id);
    $location->description = $request->input('description');
    $location->save();

    return redirect('/quest/' . $id);
});

Route::get('/monster/{id}/hp/reset', function ($id) {
    $monster = \App\Monster::with('classes')->find($id);
    $monster->hp = $monster->classes->hp;
    if ($monster->save()) {
        return response()->json(['status' => 'success', 'hp' => $monster->hp]);
    }

    return response()->json(['status' => 'fail']);
});

Route::get('/monster/{id}/hp/{hp}', function (Request $request, $id, $hp) {
    $monster = \App\Monster::find($id);
    $monster->hp = $hp;
    if ($monster->save()) {
        return response()->json(['status' => 'success']);
    }

    return response()->json(['status' => 'fail']);
});

Route::get('/building/{id}', function ($id) {
    $building = \App\Building::find($id);
    $screens = \App\Screen::where(['type' => 2, 'typeId' => $id])->get();
    return view('site.home', [
        'locations' => \App\Location::all(),
        'quests' => \App\Quest::orderBy('completed')->get(),
        'details' => $building,
        'screens' => $screens]);
});

Route::post('/building/{id}', function (Request $request, $id) {
    $building = \App\Building::find($id);
    $building->description = $request->input('description');
    $building->save();

    return redirect('/building/' . $id);
});


Route::post('/character/add', function (Request $request) {
    $data = array_merge(['class' => 2, 'hp' => 4], $request->all());

    if (!$data['buildingId']) {
        unset($data['buildingId']);
    }

    if ($id = $request->input('id')) {
        $character = \App\Character::find($id);
        $character->update($data);
    } else {
        $character = \App\Character::create($data);
    }
    $character->save();

    if ($buildingId = $request->input('buildingId')) {
        return redirect('/building/' . $buildingId);
    }

    return redirect('/location/' . $request->input('locationId'));
});

Route::post('/notes', function(Request $request) {
    if (file_put_contents(storage_path() . '/notes.txt', trim($request->get('notes'))))
    {
        return response()->json(['status' => 'success']);
    }

    return response()->json(['status' => 'fail']);
});

Route::get('cast-receiver', function() {
    return view('site.cast-receiver');
});

Route::get('/ajax/screen/{id}', function ($id) {
    $screen = \App\Screen::find($id);

    if ($id == 21) {
        $html = '<img src="/dnd/pics/21.png" style="max-width: 50%; max-height: 50%;">
            <img src="/dnd/pics/22.png" style="max-width: 50%; max-height: 50%;">
            <img src="/dnd/pics/23.png" style="max-width: 50%; max-height: 50%;">
            <img src="/dnd/pics/24.png" style="max-width: 50%; max-height: 50%;">';
    } elseif ($id == 31) {
        $html = '<img src="/dnd/pics/34.png" style="max-width: 50%; max-height: 50%;">
            <img src="/dnd/pics/35.png" style="max-width: 50%; max-height: 50%;">
            <img src="/dnd/pics/36.png" style="max-width: 50%; max-height: 50%;">';
    } else {
        $html = '<img src="' . $screen->pic . '" style="max-width: 100%; max-height: 100%;">';
    }

    return Response::json(['audio' => $screen->audio, 'pic' => $screen->pic, 'title' => $screen->name, 'html' => $html]);
});

\Illuminate\Support\Facades\View::composer(
    '*', function ($view) {
    $view->with('topLocations', App\Location::where('parent', null)->with('children')->get());
});

function subMenuNewLevel($locations) {
    $menuHtml = "";

    foreach ($locations as $location)
    {
        $children = $location->children;
        if (!$children->count()) {
            $menuHtml .= "<li><a href=\"/location/$location->id\">$location->name</a></li>";
        } else {
            $menuHtml .= "<li class=\"dropdown-submenu\">
                                <a tabindex=\"-1\" href=\"/location/$location->id\">$location->name</a></a>
                                <ul class=\"dropdown-menu\">
                                    " . subMenuNewLevel($children) . "
                                </ul>
                            </li>";
        }
    }

    return $menuHtml;
}

