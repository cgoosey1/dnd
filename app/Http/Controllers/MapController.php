<?php
namespace app\Http\Controllers;

use App\MapMarker;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class MapController extends Controller
{
    public function getIndex() {
        $markers = MapMarker::all();

        return view('site.map', ['markers' => $markers]);
    }

    public function getDelete($id) {
        $marker = MapMarker::find($id);

        if ($marker) {
            if ($marker->delete()) {
                $response = ['status' => 200, 'message' => 'Resource Deleted'];
            }
            else {
                $response = ['status' => 500, 'message' => 'Failed to delete resource with ID: ' . $id ];
            }
        }
        else {
            $response = ['status' => 404, 'message' => 'Resource with ID: ' . $id . ' not found'];
        }

        return new JsonResponse($response);
    }

    public function postAdd(Request $request) {
        if ($marker = MapMarker::create($request->all())) {
            $response = ['status' => 200, 'message' => 'Resource Created', 'id' => $marker->id];
        }
        else {
            $response = ['status' => 500, 'message' => 'Failed to create resource'];
        }

        return new JsonResponse($response);
    }
}