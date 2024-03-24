<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
//relationship test:
Route::get('/user/roadmaps/{id}', function ($id) {
    $user =User::find($id);
    return $user->roadmaps;
});
Route::get('/roadmapOfCourse/{id}', function ($id) {
    $course = \App\Models\Course::find($id);
    return $course->roadmap;
});
