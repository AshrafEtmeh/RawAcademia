<?php

use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\CourseController;
use App\Http\Controllers\api\RoadmapController;
use App\Http\Controllers\api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
//protected Routes :
Route::middleware(['jwt.verify'])->group(function () {
    Route::post('auth/logout', [AuthController::class, 'logout']);
    Route::post('auth/refresh', [AuthController::class, 'refresh']);
    Route::get('auth/user-profile', [AuthController::class, 'userProfile']);
    //user
    Route::post('/user/update/{id}', [UserController::class, 'update']);
    Route::delete('/user/destroy/{id}', [UserController::class , 'destroy']);
    //roadmap
    Route::post('/roadmap/store', [RoadmapController::class, 'store']);
    Route::post('/roadmap/update/{id}', [RoadmapController::class, 'update']);
    Route::delete('/roadmap/destroy/{id}', [RoadmapController::class , 'destroy']);
    //course
    Route::post('/course/store', [CourseController::class, 'store']);
    Route::post('/course/update/{id}', [CourseController::class, 'update']);
    Route::delete('/course/destroy/{id}', [CourseController::class , 'destroy']);
});
//authentication jwt:
Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
});
//roadmap:
Route::get('/roadmaps',[RoadmapController::class, 'index']);
Route::get('/roadmap/show/{id}',[RoadmapController::class, 'show']);
Route::get('/roadmap/search/{title}', [RoadmapController::class, 'search']);
//course:
Route::get('/courses', [CourseController::class, 'index']);
Route::get('/course/show/{id}',[CourseController::class, 'show']);
Route::get('/course/search/{link}', [CourseController::class, 'search']);
//user:
Route::get('/users',[UserController::class, 'index']);
Route::get('/user/show/{id}',[UserController::class, 'show']);
Route::get('/user/search/{constructorName}/{name}', [UserController::class, 'search']);
Route::get('/user/search/{constructorName}', [UserController::class, 'search']);
//Route::get('user/search/{name}', [UserController::class, 'search']);
