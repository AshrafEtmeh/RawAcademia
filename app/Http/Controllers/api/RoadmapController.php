<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\RoadmapResource;
use App\Models\Roadmap;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class RoadmapController extends Controller
{
    public function index() {
       $roadmaps = Roadmap::all();
       return response(RoadmapResource::collection($roadmaps),200,(array)'ok');
    }
    public function show($id) {
        $roadmap = Roadmap::find($id);
        if ($roadmap)
            return response(new RoadmapResource($roadmap),200, (array)'ok');
        return \response('not found');
    }
    public function create() {

    }
    public function edit() {

    }
    public function store(Request $request) {
        // Retrieve the authenticated user
        // method 1
        $user = Auth::guard('api')->user();
        //method 2
//        $user = $request->user();
//        $id = $request->user()->id; //or just the id
        //method 3
//        $user = auth()->user();
//        $id = auth()->id();
        //method 4
//        $user = Auth::user();
//        $id = Auth::id();


        $roadmap = Roadmap::create([
            'title' => $request->title,
            'description' => $request->description,
            'requirements' => $request->requirements,
            'recommendations' => $request->recommendations,
            'user_id' => $user->id
        ]);
        return response(new RoadmapResource($roadmap),200, (array)'ok');
    }
    public function update(Request $request,$id) {
        $roadmap = Roadmap::find($id);
        if ($roadmap) {
            $roadmap->update($request->all());
            return response(new RoadmapResource($roadmap),200,(array)'ok');
        }
        else
            return response(null,401, (array)'not found');
    }
    public function destroy($id) {
        $roadmap = Roadmap::find($id);
        if ($roadmap) {
            $roadmap->delete();
            return response('deleted');
        }
        else
            return \response('not existing');
    }
    public function search($title) {
        return RoadmapResource::collection(Roadmap::where('title', 'like' , '%'.$title.'%')->get());
    }
}
