<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CourseResource;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    use ApiResponseTrait;
    public function index() {
        $courses = Course::all();
        return $this->apiResponse(CourseResource::collection($courses),200, (array)'ok');
    }
    public function show($id) {
        $course = Course::find($id);
        if ($course)
            return $this->apiResponse(new CourseResource($course),200, (array)'ok');
        return \response('not found');
    }
    public function store(Request $request) {
        $course = Course::create($request->all());
        return response(new CourseResource($course),200, (array)'ok');
    }
    public function update(Request $request, $id) {
        $course = Course::find($id);
        if (!$course)
            return response(null,401, (array)'not found');
        $course->update($request->all());
        return  response(new CourseResource($course),200, (array)'ok');
    }
    public function destroy($id) {
        $course = Course::find($id);
        if (!$course)
            return response('not existing');
        $course->delete();
        return response('deleted');
    }
    public function search($link) {
        $courses = Course::where('link', 'like', '%'.$link.'%')->get();
        //it's not working ------
        if ($courses==null)
            return response('noting like that');
        //-----------------------
        return CourseResource::collection($courses);
    }
}
