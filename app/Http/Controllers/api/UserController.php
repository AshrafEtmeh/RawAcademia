<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\api\ApiResponseTrait;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return response($users, 200, (array)'ok');
    }

    public function show($id)
    {
        $user = User::find($id);
        if ($user)
            return response($user, 200, (array)'ok');
        return \response('not found');
    }

    public function store(Request $request)
    {
        $user = User::create($request->all());
        return response($user, 200, (array)'ok');
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        if (!$user)
            return response('user not found');
        $user->update($request->all());
        return response($user, 200, (array)'ok');
    }

    public function destroy($id)
    {
        $user = User::find($id);
        if (!$user)
            return response('user not existing');
        $user->delete();
        return response('deleted');
    }

    public function search($constructorName = null, $name = null)
    {
        if ($constructorName == null && $name == null)
            return response('you have not search for any thing');
        if ($name == null) {
            $name = $constructorName;
            return $this->extracted($constructorName, $name);
        }
        return $this->extracted($constructorName, $name);
    }

    /**
     * @param mixed $constructorName
     * @param mixed $name
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Foundation\Application|\Illuminate\Http\Response
     */
    public function extracted(mixed $constructorName, mixed $name): \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Contracts\Foundation\Application|\Illuminate\Http\Response|\Illuminate\Foundation\Application
    {
        $search1 = User::
        where('constructorName', 'like', '%' . $constructorName . '%')->
        orWhere('name', 'like', '%' . $name . '%')->get();
        if (count($search1) == 0) {
            return response([
                'message' => 'Not Found!',
                'data' => $search1,
            ], 404);
        } else {
            return response([
                'message' => 'Success',
                'data' => $search1,
            ], 200);
        }
    }
}

// git add .
// git commit -m "......"
// git push
