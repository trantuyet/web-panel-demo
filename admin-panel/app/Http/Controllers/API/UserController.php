<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return response()->json($users, 200);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid', 400]);
            }
        } catch (JWTException $exception) {
            return response()->json(['error' => 'cannot_create_token', 500]);
            }

        return response()->json(compact('token'));
    }

    public function register(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|string|max:255|unique:users',
            'password' => 'required|string|min:6'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make( $request->get('password'))
        ]);
        $token = JWTAuth::fromUser($user);

        return response()->json(compact('user', 'token'), 201);
    }

    public function update(Request $request, $id) {
        $user = User::find($id);
        $user->fill($request->all());
        $user->save();

        $data = [
           "success" => true
        ];

        return response()->json($data);
    }

    public function delete(Request $request, $id) {
        $user = User::find($id);
        $user->delete();

        $data = [
            "success" => true
        ];

        return response()->json($data);
    }
}
